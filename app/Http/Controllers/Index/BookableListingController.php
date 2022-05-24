<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\BookableListingReservationRequest;
use App\Mail\BookableListingReservationMail;
use App\Models\BookableListingRequest;
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

        $distance = $request->input('distance') ?? 100;  //(miles - see note)

        if (isset($request->query('filter')['type'])) {
            $filterTypes = explode('|', $request->query('filter')['type']);
        } else {
            $filterTypes = [];
        }

        $bookableListings = QueryBuilder::for(BookableListing::practitioners())
            ->with(['focus', 'companyBranch', 'bookable', 'location']);

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
                $locationNameRequest = Http::get('https://api.opencagedata.com/geocode/v1/json?q=' . $latitude . '+' . $longitude . '&key=a74c1f37d43a46eabdafde91d68c1448&language=en&pretty=1');

                $locationName = $locationNameRequest['results'][0]['components']['city'] . ", " . $locationNameRequest['results'][0]['components']['state_code'] . ", " . $locationNameRequest['results'][0]['components']['ISO_3166-1_alpha-3'];

            } catch(\Throwable $throwable) {
                Log::warning('Problem during practitioners search' . $throwable->getMessage());
            }

            $locationSearch = true;
        }

        $bookableListings = $bookableListings
            ->addSelect(['name', 'id', 'slug', 'bookable_listings.latitude', 'bookable_listings.longitude', 'type', 'address', 'image'])
            ->allowedSorts([
                'name',
            ])
            ->defaultSort('name')
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
                'type'
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

    public function reservationRequest(BookableListingReservationRequest $request) {

        $attributes = $request->validated();

        if (Auth::user()) {
            $attributes['user_id'] = Auth::id();
        } else {
            abort(404);
        }

        $bookableRequest = BookableListingRequest::create($attributes);

        Mail::to('sydney@withnucleus.com')->send(new BookableListingReservationMail($bookableRequest));

        return redirect()->back()->with('success', 'Your request was sent successfully!');

    }
}
