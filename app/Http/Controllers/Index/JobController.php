<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Location;
use App\Models\Company;
use App\Services\Metas;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Activitylog\Models\Activity;
use Auth;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('neuly.membership');
        $this->middleware('query_filters')->only('index');
    }

    // Index
    public function index(Request $request) {

        $jobs = QueryBuilder::for(Job::class)
            ->with('company')
            ->allowedFilters([
                AllowedFilter::exact('type', 'employment_type'),
                AllowedFilter::exact('title', 'job_title'),
                AllowedFilter::exact('locations', 'locations.name'),
                AllowedFilter::exact('company', 'company.name'),
            ])
            ->defaultSort('-posted_date')
            ->allowedSorts([
                AllowedSort::field('title', 'job_title'),
                AllowedSort::field('date', 'posted_date'),
                AllowedSort::field('type', 'employment_type'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        $locations = Location::has('jobs', '>' , 0)->with('jobs')->get()->pluck('name')->unique()->sort();

        $companies = Company::has('jobs', '>' , 0)->with('jobs')->get()->pluck('name')->unique()->sort();

        // Get All Focus Values
        // $focus_cats = Focus::pluck('name')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.jobs.index', compact('jobs', 'metas', 'locations', 'companies'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Job
        $job = Job::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $job->job_title,
            'description'   => strip_tags($job->job_description),
            'image'         => '',
        ));

        $related = $this->getReltaedEntities($job);

        $entity = 'jobs';

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'jobs',
                'slug' => $job->slug
            ])
            ->performedOn($job)
            ->log($job->job_title);

        return view('discover.jobs.show', compact('job', 'related', 'metas', 'entity'));
    }

    private function getReltaedEntities(Job $job)
    {
        $focuses = $job->focus->pluck('id');

        $relatedIds = DB::table('focus_job')
            ->select(['job_id', DB::raw('COUNT(job_id) as accurance')])
            ->whereIn('focus_id', $focuses)
            ->where('job_id', '!=', $job->id)
            ->groupBy('job_id')
            ->orderBy('accurance', 'desc')
            ->take(6)
            ->get()->pluck('job_id');

        $entities = Job::whereIn('id', $relatedIds)->get();

        return $entities;
    }
}
