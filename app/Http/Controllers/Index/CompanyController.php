<?php

namespace App\Http\Controllers\Index;

use App\Helpers\PagePreviewHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Job;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

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

    /**
     * List of Companies
     *
     * @return View
     */
    public function index(Request $request)
    {
        $companies = QueryBuilder::for(Company::class)
            ->public()
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

        $focus_cats = Focus::has('companies', '>', 0)->with('companies')->get()->pluck('name')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        return view('discover.organizations.index', compact('companies', 'focus_cats', 'metas'));
    }

    /**
     * Show Company
     *
     * @return mixed
     */
    public function show(Request $request, $slug)
    {
        $company = Company::with([
            'people',
            'locations',
            'investors',
            'jobs' => function ($query) {
                $query->open();
            },
            'events',
            'clinicaltrials',
            'parents',
            'subsidiaries',
            'valuations',
            'content',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        // Check Visibility
        $preview = $request->input('preview');
        $previewResult = PagePreviewHelper::checkEntityPreview($request, $company);

        if ($previewResult['canView'] === false) {
            if ($previewResult['redirectToRoute']) {
                return redirect()->route($previewResult['redirectToRoute']);
            }

            abort(404);
        }

        $metas = Metas::process([
            'title' => $company->name,
            'description' => $company->summary,
            'image' => $company->entityImageUrl,
        ]);

        $related = $this->getReltaedEntities($company);

        $entity = 'organizations';
        $isFollowed = (bool) count(FollowRepository::fromuser(Company::class, $company->id));

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'organizations',
                'slug' => $company->slug,
                'image' => $company->logo,
            ])
            ->performedOn($company)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($company->name);

        return view('discover.organizations.show', compact('company', 'related', 'metas', 'entity', 'isFollowed', 'preview'));
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

    /**
     * Show Jobs for Company
     *
     * @return View
     */
    public function jobs($slug)
    {
        $owner = Company::where('slug', $slug)->firstOrFail();
        $jobs = Job::where('owner_id', $owner->id)->where('status', Job::STATUS_OPEN)->orderBy('posted_date', 'desc')->get();

        return view('discover.jobs.listing-by-owner', compact('owner', 'jobs'));
    }

    /**
     * Show Events for Company
     *
     * @return View
     */
    public function events($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $entity = 'organizations';

        return view('discover.organizations.events', compact('company', 'entity'));
    }
}
