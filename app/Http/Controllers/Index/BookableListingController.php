<?php

namespace App\Http\Controllers\Index;

use App\Helpers\NotificationHelper;
use App\Helpers\StringHelper;
use App\Http\Requests\BookableListingReservationRequest;
use App\Http\Requests\StoreBookableListingRequest;
use App\Mail\BookableListingForReviewMail;
use App\Mail\BookableListingReservationMail;
use App\Models\BookableListingRequest;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Person;
use App\Notifications\BookableListingNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BookableListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookableListingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('query_filters')->only('index');
    }

    public function index(Request $request) {

        // TODO: Validation on LAT/LONG/DISTANCE

        $latitude = $request->input('latitude') ?? NULL;
        $longitude = $request->input('longitude') ?? NULL;
        $locationName = 'your location';
        $locationSearch = false;
        $virtual = false;
        $filterTypes = [];

        if (isset($request->query('filter')['virtual'])) {
            $virtual = true;
        }

        if (isset($request->query('filter')['type'])) {
            $filterTypes = explode('|', $request->query('filter')['type']);
        }

        $distance = $request->input('distance') ?? 100;  //(miles - see note)

        $bookableListings = QueryBuilder::for(BookableListing::public()->practitioners());

        if ($latitude !== NULL AND $longitude !== NULL) {
            $bookableListings = $bookableListings->selectRaw('(3959 * acos (
                cos ( radians(?) )
                * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?) )
                + sin ( radians(?) )
                * sin( radians( latitude )))) AS distance', [
                $latitude,
                $longitude,
                $latitude
            ])
                ->havingRaw('distance <= ? OR 0', [$distance])
                ->orderBy('distance', 'asc');

            try {
                $locationNameRequest = Http::get('https://api.opencagedata.com/geocode/v1/json?q=' . $latitude . '+' . $longitude . '&key=' . config('services.opencage.api_key'));

                $locationName = $locationNameRequest['results'][0]['components']['city'] . ", " . $locationNameRequest['results'][0]['components']['state_code'] . ", " . $locationNameRequest['results'][0]['components']['ISO_3166-1_alpha-3'];

            } catch(\Throwable $throwable) {
                Log::warning('Problem during practitioners search' . $throwable->getMessage());
            }

            $locationSearch = true;
        }

        $bookableListings = $bookableListings
            ->addSelect(['name', 'id', 'slug', 'location_name', 'latitude', 'longitude', 'type', 'address', 'image', 'virtual'])
            ->allowedSorts([
                'name',
            ])
            ->defaultSort('name')
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
                'type',
                'virtual'
            ])
            ->paginate(15)
            ->appends(request()->query());

        $filterTypeOptions = BookableListing::practitioners()->pluck('type')->unique()->toArray();
        $filterDistanceOptions = [5, 10, 15, 25, 50, 100, 250, 500];

        return view('discover.bookable-listings.index', [
            'bookableListings' => $bookableListings,
            'filterTypeOptions' => $filterTypeOptions,
            'filterDistanceOptions' => $filterDistanceOptions,
            'filterLatitude' => $latitude,
            'filterLongitude' => $longitude,
            'filterDistance' => $distance,
            'filterTypes' => $filterTypes,
            'filterVirtual' => $virtual,
            'locationName' => $locationName,
            'locationSearch' => $locationSearch
        ]);
    }

    public function show($slug) {

        $bookableListing = BookableListing::with('bookable')->where([
            'slug' => $slug
        ])->firstOrFail();

        $bookableEntity = match($bookableListing->bookable_type) {
            'App\Models\Company' => 'organizations',
            'App\Models\Person' => 'people',
            'App\Models\Course' => 'courses',
        };

        return view('discover.bookable-listings.show', [
            'bookableListing' => $bookableListing,
            'bookableEntity' => $bookableEntity,
        ]);
    }

    public function reservationRequest(BookableListingReservationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validated();

        if (Auth::user()) {
            $attributes['user_id'] = Auth::id();
        } else {
            abort(404);
        }

        $bookableRequest = BookableListingRequest::create($attributes);

        // TODO: where these going??
        $emails = config('mail.custom.admin_notifications_email');
        $emailArray    = StringHelper::explodeAndFilterEmpty($emails, ',');
        Mail::to($emailArray)->send(new BookableListingReservationMail($bookableRequest));

        return redirect()->back()->with('success', 'Your request was sent successfully!');

    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $types = BookableListing::TYPES_CARE;
        $focuses = Focus::drugs()->pluck('name', 'id')->toArray();

        $organizations = Company::public()->pluck('name', 'id');
        $people = Person::public()->pluck('name', 'id');

        return view('discover.bookable-listings.create', [
            'types' => $types,
            'organizations' => $organizations,
            'people' => $people,
            'focuses' => $focuses
        ]);
    }

    public function store(StoreBookableListingRequest $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validated();

        $bookableDetails = explode('-', $attributes['bookable_id']);

        $attributes['user_id'] = Auth::id();
        $attributes['bookable_id'] = $bookableDetails[1];

        $attributes['bookable_type'] = match($bookableDetails[0]) {
            'person' => Person::class,
            'organization' => Company::class,
        };

        $attributes['status'] = $this->getNewBookableListingStatus();

        $bookableListing = BookableListing::create($attributes);

        $bookableListing->image = $bookableListing->bookable->entityImageUrl;
        $bookableListing->save();

        // Focus
        if (!empty($attributes['focus'])) {
            $bookableListing->focus()->syncWithoutDetaching(array_keys($attributes['focus']));
        }

        // Add Description to Entity Content
        $bookableListing->content()->create([
           'name' => 'Description',
           'order' => 1,
           'content' => $attributes['description']
        ]);

        // TODO: Create New Locations if no match
        $locationName = $attributes['location_name'];

        $matchingLocation = Location::where('name', $locationName)->first();

        if ($matchingLocation) {
            $bookableListing->location_id = $matchingLocation->id;
            $bookableListing->save();
        }

        if ($bookableListing->status == BookableListing::STATUS_PENDING) {
            NotificationHelper::sendAdminNotifications(new BookableListingNotification($bookableListing));
        }

        return redirect()->route('discover.bookable-listing.show', $bookableListing->slug);
    }

    private function getNewBookableListingStatus(): string
    {
        if (Auth::user()->can('edit companies')) {
            return BookableListing::STATUS_PUBLIC;
        } else {
            return BookableListing::STATUS_PENDING;
        }
    }
}
