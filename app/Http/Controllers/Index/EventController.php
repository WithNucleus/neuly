<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Company;
use Carbon\Carbon;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use App\Repositories\BookmarkRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index', 'past');
    }

    // Upcoming Events
    public function index(Request $request) {

        // Get Events
        $events = QueryBuilder::for(Event::class)
            ->where('start_date', '>=', Carbon::now('America/Chicago'))
            ->with('companies')
            ->allowedFilters([
                'name',
                AllowedFilter::partial('type', 'event_types.name'),
                AllowedFilter::partial('company', 'companies.name'),
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('focus', 'focus.name'),
            ])
            ->defaultSort('start_date')
            ->allowedSorts([
                'name',
                AllowedSort::field('date', 'start_date'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        // Get Focus Values
        $focus_cats = Focus::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '>=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('name');

        // Event Types
        $event_types = EventType::has('events', '>' , 0)->with('events')->get()->pluck('name');

        // Organizations
        $event_organizations = Company::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '>=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('name');

        // Locations
        $locations = Location::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '>=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('country')->unique()->sort();

        // Metas
        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.events.index', compact('events', 'focus_cats', 'event_types', 'metas', 'locations', 'event_organizations'));
    }

    // Past Events
    public function past(Request $request) {

        // Get Events
        $events = QueryBuilder::for(Event::class)
            ->where('start_date', '<=', Carbon::now('America/Chicago'))
            ->with('companies')
            ->allowedFilters([
                'name',
                AllowedFilter::partial('type', 'event_types.name'),
                AllowedFilter::partial('company', 'companies.name'),
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('focus', 'focus.name'),
            ])
            ->defaultSort('-start_date')
            ->allowedSorts([
                'name',
                AllowedSort::field('date', 'start_date'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        // Get Focus Values
        $focus_cats = Focus::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '<=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('name');

        // Event Types
        $event_types = EventType::has('events', '>' , 0)->with('events')->get()->pluck('name');

        // Organizations
        $event_organizations = Company::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '<=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('name');

        // Locations
        $locations = Location::whereHas('events', function (Builder $query) {
                    $query->where('start_date', '<=', Carbon::now('America/Chicago'));
                })
                ->get()
                ->pluck('country')->unique()->sort();

        // Metas
        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.events.index', compact('events', 'focus_cats', 'event_types', 'metas', 'locations', 'event_organizations'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Event
        $event = Event::where('slug', $slug)->first();

        $metas = Metas::process(array(
            'title'         => $event->name,
            'description'   => strip_tags($event->description),
            'image'         => '',
        ));

        $related = $this->getReltaedEntities($event);

        $entity = 'events';
        $bookmarks = BookmarkRepository::fromUser($entity, $event->id);
        $isFollowed = (bool) count(FollowRepository::fromuser(Event::class, $event->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'events',
                'slug' => $event->slug
            ])
            ->performedOn($event)
            ->log($event->name);

        return view('discover.events.show', compact('event', 'related', 'metas', 'entity', 'bookmarks', 'isFollowed'));
    }

    private function getReltaedEntities(Event $event)
    {
        $focuses = $event->focus->pluck('id');

        $relatedIds = DB::table('event_focus')
            ->select(['event_id', DB::raw('COUNT(event_id) as accurance')])
            ->whereIn('focus_id', $focuses)
            ->where('event_id', '!=', $event->id)
            ->groupBy('event_id')
            ->orderBy('accurance', 'desc')
            ->take(6)
            ->get()->pluck('event_id');

        $entities = Event::whereIn('id', $relatedIds)->get();

        return $entities;
    }

    public function namesJson()
    {
        return response()->json(Event::all()->pluck('name'));
    }

}
