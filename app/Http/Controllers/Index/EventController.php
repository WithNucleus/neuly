<?php

namespace App\Http\Controllers\Index;

use App\Helpers\EmbedLogHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Focus;
use App\Models\Location;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index', 'past', 'embedIndex');
    }

    // Upcoming Events
    public function index(Request $request)
    {
        $data = $this->getIndexData($request);
        $data['metas'] = Metas::fromPage($request->path());

        return view('discover.events.index', $data);
    }

    // Past Events
    public function past(Request $request)
    {
        // Get Events
        $events = QueryBuilder::for(Event::class)
            ->where('start_date', '<=', Carbon::now('America/Chicago'))
            ->with(['companies', 'eventTypes', 'locations', 'focus', 'eventTypes'])
            ->allowedFilters([
                'name',
                AllowedFilter::partial('type', 'eventTypes.name'),
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
        $event_types = EventType::has('events', '>', 0)->with('events')->get()->pluck('name');

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

    public function show(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        EmbedLogHelper::add($request, $event);

        $metas = Metas::process([
            'title' => $event->name,
            'description' => strip_tags($event->description),
            'image' => '',
        ]);

        $related = $this->getRelatedEntities($event);

        $entity = 'events';
        $isFollowed = (bool) count(FollowRepository::fromuser(Event::class, $event->id));

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'events',
                'slug' => $event->slug,
                'image' => $event->image,
            ])
            ->performedOn($event)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($event->name);

        return view('discover.events.show', compact('event', 'related', 'metas', 'entity', 'isFollowed'));
    }

    public function embedWidget()
    {
        $title = 'Events';
        $previousUrl = route('discover.events');
        $embedUrl = route('embeds.events.index');

        return view('discover.embed-widget', compact('title', 'previousUrl', 'embedUrl'));
    }

    public function embedIndex(Request $request)
    {
        $data = $this->getIndexData($request);

        return view('discover.events.embed-index', $data);
    }

    private function getIndexData(Request $request)
    {
        $now = Carbon::now(config('app.timezone'));

        $events = QueryBuilder::for(Event::class)
            ->where('start_date', '>=', $now)
            ->with(['companies', 'eventTypes', 'locations', 'focus', 'eventTypes'])
            ->allowedFilters([
                'name',
                AllowedFilter::partial('type', 'eventTypes.name'),
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

        $event_types = EventType::whereHas('events')->get()->pluck('name');

        $focus_cats = Focus::whereHas('events', function (Builder $query) use ($now) {
            $query->where('start_date', '>=', $now);
        })
            ->get()
            ->pluck('name');

        $event_organizations = Company::whereHas('events', function (Builder $query) use ($now) {
            $query->where('start_date', '>=', $now);
        })
            ->get()
            ->pluck('name');

        $locations = Location::whereHas('events', function (Builder $query) use ($now) {
            $query->where('start_date', '>=', $now);
        })
            ->get()
            ->pluck('country')
            ->unique()
            ->sort();

        return [
            'events' => $events,
            'event_types' => $event_types,
            'focus_cats' => $focus_cats,
            'event_organizations' => $event_organizations,
            'locations' => $locations,
        ];
    }

    private function getRelatedEntities(Event $event)
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
