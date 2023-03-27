<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use App\Services\StringLengthSort;
use Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

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

    /**
     * List of Investors
     *
     * @return View
     */
    public function index(Request $request)
    {
        $investors = QueryBuilder::for(Investor::class)
            ->with('companies')
            ->allowedFilters([
                'name', 'type',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
                AllowedFilter::scope('hiring', 'hasJobs'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name', 'type',
                AllowedSort::custom('thisIsATest', new StringLengthSort(), 'name'),
            ])
            ->paginate(12)
            ->appends(request()->query());

        $types = Investor::pluck('type')->unique()->sort();

        $locations = Location::has('investors', '>', 0)->with('investors')->get()->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.investors.index', compact('investors', 'types', 'metas', 'locations'));
    }

    /**
     * Show Investor
     *
     * @return View
     */
    public function show(Request $request, $slug)
    {
        $investor = Investor::where('slug', $slug)->firstOrFail();

        $metas = Metas::process([
            'title' => $investor->name,
            'description' => '',
            'image' => '',
        ]);

        $entity = 'investors';
        $isFollowed = (bool) count(FollowRepository::fromuser(Investor::class, $investor->id));

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'investors',
                'slug' => $investor->slug,
                'image' => $investor->logo,
            ])
            ->performedOn($investor)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($investor->name);

        return view('discover.investors.show', compact('investor', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Investor::all()->pluck('name'));
    }

    /**
     * Show Jobs for Investor
     *
     * @return View
     */
    public function jobs($slug)
    {
        $owner = Investor::where('slug', $slug)->firstOrFail();
        $jobs = Job::where('owner_id', $owner->id)->where('status', Job::STATUS_OPEN)->orderBy('posted_date', 'desc')->get();

        return view('discover.jobs.listing-by-owner', compact('owner', 'jobs'));
    }
}
