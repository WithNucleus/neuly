<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LocationController extends Controller
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

    // Index
    public function index(Request $request)
    {
        // Get Location
        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters([
                'region',
                AllowedFilter::partial('locations', 'name'),
                AllowedFilter::partial('countries', 'country'),
                AllowedFilter::exact('regions', 'region'),
                AllowedFilter::partial('city', 'name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('investors', 'investors.name'),
                AllowedFilter::partial('company', 'company.name'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name', 'city', 'region', 'country',
            ])
            ->paginate(50)
            ->appends(request()->query());

        // Get Countries
        $all_locations = Location::all();
        $countries = $all_locations->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.locations.index', compact('locations', 'countries', 'metas'));
    }

    // Show
    public function show(Request $request, $slug)
    {
        // Get Location
        $location = Location::where('slug', $slug)->firstOrFail();

        $metas = Metas::process([
            'title' => $location->name,
            'description' => '',
            'image' => '',
        ]);

        $entity = 'locations';
        $isFollowed = (bool) count(FollowRepository::fromuser(Location::class, $location->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'locations',
                'slug' => $location->slug,
            ])
            ->performedOn($location)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($location->name);

        return view('discover.locations.show', compact('location', 'metas', 'entity', 'isFollowed'));
    }

    /**
     * Gets the city names.
     *
     * @return City names in JSON.
     */
    public function citynames()
    {
        return response()->json(Location::all()->pluck('name'));
    }
}
