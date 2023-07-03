<?php

namespace App\Http\Controllers\Index;

use App\Helpers\EmbedLogHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class JobController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $data['metas'] = Metas::fromPage($request->path());

        return view('discover.jobs.index', $data);
    }

    public function archive(Request $request)
    {
        $data = $this->getIndexData($request, 'archived');
        $data['metas'] = Metas::fromPage($request->path());

        return view('discover.jobs.index', $data);
    }

    // Show
    public function show(Request $request, $slug)
    {
        // Get Job
        $job = Job::where('slug', $slug)->firstOrFail();

        EmbedLogHelper::add($request, $job);

        $metas = Metas::process([
            'title' => $job->job_title,
            'description' => strip_tags($job->job_description),
            'image' => '',
        ]);

        $related = $this->getReltaedEntities($job);

        $entity = 'jobs';

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'jobs',
                'slug' => $job->slug,
            ])
            ->performedOn($job)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($job->job_title);

        return view('discover.jobs.show', compact('job', 'related', 'metas', 'entity'));
    }

    public function embedWidget()
    {
        $title = 'Jobs';
        $previousUrl = route('discover.jobs');
        $embedUrl = route('embeds.jobs.index');

        return view('discover.embed-widget', compact('title', 'previousUrl', 'embedUrl'));
    }

    public function embedIndex(Request $request)
    {
        $data = $this->getIndexData($request, 'open');

        return view('discover.jobs.embed-index', $data);
    }

    public function titlesJson()
    {
        $data = Job::all()->pluck('job_title');

        return response()->json($data, Response::HTTP_OK);
    }

    private function getIndexData(Request $request, $jobStatus)
    {
        $jobs = QueryBuilder::for(Job::class)
            ->with('owner')
            ->where('status', $jobStatus)
            ->allowedFilters([
                AllowedFilter::exact('type', 'employment_type'),
                AllowedFilter::exact('title', 'job_title'),
                AllowedFilter::exact('locations', 'locations.name'),
                AllowedFilter::partial('company', 'company.name'),
                AllowedFilter::partial('investor', 'investor.name'),
            ])
            ->defaultSort('-posted_date')
            ->allowedSorts([
                AllowedSort::field('title', 'job_title'),
                AllowedSort::field('date', 'posted_date'),
                AllowedSort::field('type', 'employment_type'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        $locations = Location::whereHas('jobs')->get()->pluck('name')->unique()->sort();
        $companies = Company::whereHas('jobs')->get()->pluck('name')->unique()->sort();
        $investors = Investor::whereHas('jobs')->get()->pluck('name')->unique()->sort();

        return [
            'jobs' => $jobs,
            'locations' => $locations,
            'companies' => $companies,
            'investors' => $investors,
        ];
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
