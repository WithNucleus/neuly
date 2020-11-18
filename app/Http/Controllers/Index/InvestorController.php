<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Location;
use App\Services\Metas;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
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

    /**
     * List of Investors
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) {

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

        $locations = Location::has('investors', '>' , 0)->with('investors')->get()->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.investors.index', compact('investors', 'types', 'metas', 'locations'));

    }

    /**
     * Show Investor
     *
     * @param Request $request
     * @param $slug
     * @return View
     */
    public function show(Request $request, $slug) {

        $investor = Investor::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $investor->name,
            'description'   => '',
            'image'         => '',
        ));

        $entity = 'investors';
        $isFollowed = (bool) count(FollowRepository::fromuser(Investor::class, $investor->id));

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

        return view('discover.investors.show', compact('investor', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Investor::all()->pluck('name'));
    }

    /**
     * Show Jobs for Investor
     *
     * @param $slug
     * @return View
     */
    public function jobs($slug) {

        $investor = Investor::where('slug', $slug)->firstOrFail();
        $jobs = Job::where('owner_id', $investor->id)->orderBy('posted_date', 'desc')->get();
        $entity = 'investors';

        return view('discover.investors.jobs', compact('investor', 'jobs', 'entity'));
    }
}
