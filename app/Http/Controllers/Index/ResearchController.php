<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\Focus;
use App\Models\Person;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;

class ResearchController extends Controller
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

        $research_items = QueryBuilder::for(Research::class)
            ->allowedFilters([
                'name',
                'publication_info',
                'abstract',
                'companies.name',
                AllowedFilter::exact('focus', 'focus.name'),
                AllowedFilter::exact('people', 'people.name'),
            ])
            ->defaultSort('-created_at')
            ->allowedSorts([
                AllowedSort::field('title', 'name'),
                AllowedSort::field('date', 'created_at'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        $focus_cats = Focus::drugs()->orderBy('name')->get()->pluck('name');

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.research.index', compact('research_items', 'focus_cats', 'metas'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Research
        $research = Research::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $research->name,
            'description'   => $research->abstract,
            'image'         => '',
        ));

        $related = $this->getReltaedEntities($research);

        $entity = 'research';
        $isFollowed = (bool) count(FollowRepository::fromuser(Research::class, $research->id));

        $resources = json_decode($research->resources);

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'research',
                'slug' => $research->slug
            ])
            ->performedOn($research)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($research->name);

        return view('discover.research.show', compact('research','related', 'metas', 'entity', 'resources', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Research::all()->pluck('name'));
    }

    private function getReltaedEntities(Research $research)
    {
        $focuses = $research->focus->pluck('id');

        $relatedIds = DB::table('focus_research')
            ->select(['research_id', DB::raw('COUNT(research_id) as accurance')])
            ->whereIn('focus_id', $focuses)
            ->where('research_id', '!=', $research->id)
            ->groupBy('research_id')
            ->orderBy('accurance', 'desc')
            ->take(6)
            ->get()->pluck('research_id');

        $entities = Research::whereIn('id', $relatedIds)->get();

        return $entities;
    }
}
