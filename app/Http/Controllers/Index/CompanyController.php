<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Job;
use App\Models\Event;
use App\Models\Location;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use Auth;
use Spatie\Activitylog\Models\Activity;

class CompanyController extends Controller
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

        // Get Companies
        $companies = QueryBuilder::for(Company::class)
            ->with('focus')
            ->allowedFilters([
                'name',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::exact('type', 'ownership'),
                AllowedFilter::scope('hiring', 'hasJobs'),
                AllowedFilter::scope('upcoming_events', 'hasUpcomingEvents'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name',
                AllowedSort::field('date', 'created_at'),
                AllowedSort::field('type', 'ownership'),
            ])
            ->paginate(12)
            ->appends(request()->query());

        // Get All Focus Values
        $focus_cats = Focus::has('companies', '>' , 0)->with('companies')->get()->pluck('name')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.organizations.index', compact('companies', 'focus_cats', 'metas'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Company
        $company = Company::with([
                'people',
                'locations',
                'investors',
                'jobs',
                'events',
                'clinicaltrials',
                'parents',
                'subsidiaries',
                'valuations',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $company->name,
            'description'   => $company->summary,
            'image'         => $company->entityImageUrl,
        ));

        $related = $this->getReltaedEntities($company);

        $entity = 'organizations';
        $isFollowed = (bool) count(FollowRepository::fromuser(Company::class, $company->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'organizations',
                'slug' => $company->slug,
                'image' => $company->logo
            ])
            ->performedOn($company)
            ->log($company->name);

        return view('discover.organizations.show', compact('company', 'related', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Company::all()->pluck('name'));
    }

    private function getReltaedEntities(Company $company)
    {
        $focuses = $company->focus->pluck('id');

        $relatedIds = DB::table('company_focus')
                        ->select(['company_id', DB::raw('COUNT(company_id) as accurance')])
                        ->whereIn('focus_id', $focuses)
                        ->where('company_id', '!=', $company->id)
                        ->groupBy('company_id')
                        ->orderBy('accurance', 'desc')
                        ->take(6)
                        ->get()->pluck('company_id');

        $entities = Company::whereIn('id', $relatedIds)->get();

        return $entities;
    }

    // Show Jobs for this Company
    public function jobs($slug) {

        // Get Company
        $company = Company::where('slug', $slug)->firstOrFail();

        // Get Jobs
        $jobs = Job::where('company_id', $company->id)->orderBy('posted_date', 'desc')->get();

        $entity = 'organizations';

        // Return View
        return view('discover.organizations.jobs', compact('company', 'jobs', 'entity'));
    }

    // Show Events for this Company
    public function events($slug) {

        // Get Company
        $company = Company::where('slug', $slug)->firstOrFail();

        $entity = 'organizations';

        // Return View
        return view('discover.organizations.events', compact('company', 'entity'));
    }
}
