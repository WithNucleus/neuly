<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use App\Repositories\BookmarkRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;

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
    public function index(Request $request) {

        // Get Location
        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters([
                'region',
                AllowedFilter::partial('locations', 'name'),
                AllowedFilter::partial('countries', 'country'),
                AllowedFilter::partial('city', 'name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('investors', 'investors.name'),
                AllowedFilter::partial('company', 'company.name'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name', 'city', 'region', 'country'
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
    public function show(Request $request, $slug) {

        // Get Location
        $location = Location::where('slug', $slug)->first();

        $metas = Metas::process(array(
            'title'         => $location->name,
            'description'   => '',
            'image'         => '',
        ));

        $entity = 'locations';
        $bookmarks = BookmarkRepository::fromUser($entity, $location->id);
        $isFollowed = (bool) count(FollowRepository::fromuser(Location::class, $location->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'locations',
                'slug' => $location->slug
            ])
            ->performedOn($location)
            ->log($location->name);

        return view('discover.locations.show', compact('location', 'metas', 'entity', 'bookmarks', 'isFollowed'));
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
