<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Focus;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use App\Repositories\BookmarkRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;
use App\Services\StringLengthSort;

class InvestorController extends Controller
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

        // Get Investors
        $investors = QueryBuilder::for(Investor::class)
            ->with('companies')
            ->allowedFilters([
                'name', 'type',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name', 'type',
                AllowedSort::custom('thisIsATest', new StringLengthSort(), 'name'),
            ])
            ->paginate(12)
            ->appends(request()->query());

        $types = Investor::pluck('type')->unique()->sort();

        $locations = Location::has('investors', '>' , 0)->with('investors')->get()->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.investors.index', compact('investors', 'types', 'metas', 'locations'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Investor
        $investor = Investor::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $investor->name,
            'description'   => '',
            'image'         => '',
        ));

        $related = $this->getReltaedEntities($investor);

        $entity = 'investors';
        $bookmarks = BookmarkRepository::fromUser($entity, $investor->id);
        $isFollowed = (bool) count(FollowRepository::fromuser(Investor::class, $investor->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'investors',
                'slug' => $investor->slug,
                'image' => $investor->logo
            ])
            ->performedOn($investor)
            ->log($investor->name);

        return view('discover.investors.show', compact('investor', 'related', 'metas', 'entity', 'bookmarks', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Investor::all()->pluck('name'));
    }

    private function getReltaedEntities(Investor $investor)
    {
        $focuses = $investor->focus->pluck('id');

        $relatedIds = DB::table('focus_investor')
            ->select(['investor_id', DB::raw('COUNT(investor_id) as accurance')])
            ->whereIn('focus_id', $focuses)
            ->where('investor_id', '!=', $investor->id)
            ->groupBy('investor_id')
            ->orderBy('accurance', 'desc')
            ->take(6)
            ->get()->pluck('investor_id');

        $entities = Investor::whereIn('id', $relatedIds)->get();

        return $entities;
    }
}
