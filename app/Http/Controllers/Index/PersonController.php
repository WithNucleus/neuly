<?php

namespace App\Http\Controllers\Index;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Notifications\PersonDeletionRequested;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\DB;
use App\Services\Metas;
use Spatie\Activitylog\Models\Activity;
use Auth;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    // Public / Private Index for Homepage
    public function index(Request $request) {

        // Get People
        $people = QueryBuilder::for(Person::class)
            ->with('companies')
            ->allowedFilters([
                'name',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('-created_at')
            ->allowedSorts([
                'name',
                AllowedSort::field('date', 'created_at'),
            ])
            ->paginate(25)
            ->appends(request()->query());

        $locations = Location::has('people', '>' , 0)->with('people')->get()->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.people.index', compact('people', 'metas', 'locations'));

    }

    // Show More Info -- Full Layout
    public function show(Request $request, $slug) {

        // Get Person
        $person = Person::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $person->name,
            'description'   => $person->bio,
            'image'         => $person->entityImageUrl,
        ));

        $entity = 'people';
        $isFollowed = (bool) count(FollowRepository::fromuser(Person::class, $person->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'people',
                'slug' => $person->slug
            ])
            ->performedOn($person)
            ->log($person->name);

        return view('discover.people.show', compact('person', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Person::all()->pluck('name'));
    }

    public function requestDeletion($slug)
    {
        $person = Person::where('slug', $slug)->firstOrFail();

        return view('discover.people.requestDeletion', compact('person'));
    }

    public function requestDeletionSubmit(Request $request, $slug)
    {
        $person = Person::where('slug', $slug)->firstOrFail();
        $name   = $request->input('name');
        $email  = $request->input('email');
        $cause  = $request->input('cause');

        $notification = new PersonDeletionRequested($person, $name, $email, $cause);
        NotificationHelper::sendAdminNotifications($notification);

        return redirect()
            ->route('discover.people.show', $person->slug)
            ->with('success', 'Your deletion request sent successfully!');
    }
}
