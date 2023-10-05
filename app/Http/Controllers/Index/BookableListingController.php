<?php

namespace App\Http\Controllers\Index;

use App\Helpers\NotificationHelper;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookableListingReservationRequest;
use App\Http\Requests\StoreBookableListingRequest;
use App\Mail\BookableListingReservationMail;
use App\Models\BookableListing;
use App\Models\BookableListingRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Person;
use App\Notifications\BookableListingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookableListingController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.bookable-listings.index');
    }

    public function show($slug)
    {
        $bookableListing = BookableListing::with('bookable')->where([
            'slug' => $slug,
        ])->firstOrFail();

        $bookableEntity = match ($bookableListing->bookable_type) {
            \App\Models\Company::class => 'organizations',
            \App\Models\Person::class => 'people',
            \App\Models\Course::class => 'courses',
            \App\Models\Event::class => 'events',
        };

        return view('discover.bookable-listings.show', [
            'bookableListing' => $bookableListing,
            'bookableEntity' => $bookableEntity,
        ]);
    }

    public function reservationRequest(BookableListingReservationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validated();

        $attributes['user_id'] = Auth::id();

        $bookableRequest = BookableListingRequest::create($attributes);

        // TODO: where these going??
        $emails = config('mail.custom.admin_notifications_email');
        $emailArray = StringHelper::explodeAndFilterEmpty($emails, ',');
        Mail::to($emailArray)->send(new BookableListingReservationMail($bookableRequest));

        return redirect()->back()->with('success', 'Your request was sent successfully!');
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $types = BookableListing::TYPES_CARE;
        $focuses = Focus::drugs()->pluck('name', 'id')->toArray();

        $organizations = Company::public()->pluck('name', 'id');
        $people = Person::public()->pluck('name', 'id');
        $events = Event::upcoming()->pluck('name', 'id');

        return view('discover.bookable-listings.create', [
            'types' => $types,
            'organizations' => $organizations,
            'people' => $people,
            'events' => $events,
            'focuses' => $focuses,
        ]);
    }

    public function store(StoreBookableListingRequest $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validated();

        $bookableDetails = explode('-', $attributes['bookable_id']);

        $attributes['user_id'] = Auth::id();
        $attributes['bookable_id'] = $bookableDetails[1];

        $attributes['bookable_type'] = match ($bookableDetails[0]) {
            'person' => Person::class,
            'organization' => Company::class,
            'event' => Event::class,
        };

        $attributes['status'] = $this->getNewBookableListingStatus();

        $bookableListing = BookableListing::create($attributes);

        // TODO: Create New Locations if no match
        $locationName = $attributes['location_name'];

        $matchingLocation = Location::where('name', $locationName)->first();

        if ($matchingLocation) {
            $bookableListing->location_id = $matchingLocation->id;
        }

        if ($attributes['bookable_type'] == Event::class) {
            $event = Event::find($attributes['bookable_id']);

            if ($event) {
                $bookableListing->start_date = $event->start_date;
                $bookableListing->end_date = $event->end_date;
            }
        }

        $bookableListing->save();

        // Focus
        if (! empty($attributes['focus'])) {
            $bookableListing->focus()->syncWithoutDetaching(array_keys($attributes['focus']));
        }

        // Add Description to Entity Content
        $bookableListing->content()->create([
            'name' => 'Description',
            'order' => 1,
            'content' => $attributes['description'],
        ]);

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
