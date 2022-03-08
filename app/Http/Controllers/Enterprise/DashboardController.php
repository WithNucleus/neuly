<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Follow;
use App\Models\FollowList;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\MediaItem;
use App\Models\MemberNote;
use App\Models\Patent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class DashboardController extends Controller
{
    public function index() {
        return view('enterprise.dashboard');
    }

    public function combinedFeedWidget(Request $request): string
    {
        $pageFilters = $request->input('page');
        $maxResults = $pageFilters['size'] ?? 10;

        $feed = QueryBuilder::for(MediaItem::class)
            ->enterpriseCombinedFeed()
            ->public()
            ->with(['focus'])
            ->allowedFilters([
                'name',
                AllowedFilter::exact('focus', 'focus.name'),
                AllowedFilter::exact('type', 'media_type'),
            ])
            ->defaultSort('-date')
            ->allowedSorts([
                AllowedSort::field('date', 'date'),
            ])
            ->jsonPaginate($maxResults)
            ->appends(request()->query());

        return View::make("enterprise.widgets.combined-feed")
            ->with([
                'feed' => $feed
            ])
            ->render();
    }

    public function userFollowsWidget(Request $request): string
    {
        $followLists = FollowList::with('followItems')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $follows = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return View::make("enterprise.widgets.follows")
            ->with([
                'followLists' => $followLists,
                'follows' => $follows
            ])
            ->render();
    }

    public function userNotesWidget (): string
    {
        $notes = MemberNote::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return View::make("enterprise.widgets.notes")
            ->with([
                'notes' => $notes,
            ])
            ->render();
    }

    public function userRecentlyViewedWidget(): string
    {
        $lastActivityIdsByType = Activity::select(DB::raw('MAX(id) AS id, MAX(created_at) AS created_at'))
            ->where('causer_id', Auth::id())
            ->where('causer_type', 'App\User')
            ->where('log_name', 'pageview')
            ->groupBy(['subject_id', 'subject_type'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->pluck('id')
            ->all();

        $recently_viewed = Activity::whereIn('id', $lastActivityIdsByType)
            ->orderBy('created_at', 'desc')
            ->get();

        return View::make("enterprise.widgets.recently-viewed")
            ->with([
                'recently_viewed' => $recently_viewed,
            ])
            ->render();
    }

    public function teamWidget(): string
    {
        $user = auth()->user();
        $team = null;

        if ($user->hasRole('Team owner')) {
            $team = $user->ownedTeam()->with(['members', 'invitations'])->first();
        } elseif ($user->hasRole('Team member')) {
            $team = $user->team()->with(['members', 'owner'])->first();
        }

        return View::make("enterprise.widgets.team")
            ->with([
                'user' => $user,
                'team' => $team,
            ])
            ->render();
    }

    public function patentsWidget(Request $request): string
    {
        $pageFilters = $request->input('page');
        $maxResults = $pageFilters['size'] ?? 5;

        $patents = QueryBuilder::for(Patent::class)
            ->with([
                'companies',
                'people',
                'focus'
            ])->allowedSorts([
                'name',
                'priority_date',
                'granted_date',
                'expiration_date'
            ])
            ->allowedFilters([
                'status',
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('-priority_date')
            ->jsonPaginate($maxResults)
            ->appends(request()->query());

        $focusList = Focus::whereHas('patents')->orderBy('name')->pluck('name', 'slug')->toArray();

        return View::make("enterprise.widgets.patents")
            ->with([
                'patents' => $patents,
                'focusList' => $focusList
            ])
            ->render();
    }

    public function clinicalTrialsWidget(Request $request): string
    {
        $pageFilters = $request->input('page');
        $maxResults = $pageFilters['size'] ?? 5;

        $clinicalTrials = QueryBuilder::for(Clinicaltrial::class)
            ->with([
                'companies',
                'people',
                'focus'
            ])->allowedSorts([
                'title',
                'start_date'
            ])
            ->allowedFilters([
                'status',
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('-start_date')
            ->jsonPaginate($maxResults)
            ->appends(request()->query());

        $focusList = Focus::whereHas('clinicaltrials')->orderBy('name')->pluck('name', 'slug')->toArray();

        return View::make("enterprise.widgets.clinical-trials")
            ->with([
                'clinicalTrials' => $clinicalTrials,
                'focusList' => $focusList
            ])
            ->render();
    }

    public function jobsWidget(Request $request): string
    {
        $pageFilters = $request->input('page');
        $maxResults = $pageFilters['size'] ?? 5;

        $jobs = QueryBuilder::for(Job::class)
            ->with('owner')
            ->where('status', Job::STATUS_OPEN)
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
            ->paginate($maxResults)
            ->appends(request()->query());

        $locations = Location::whereHas('jobs')->get()->pluck('name')->unique()->sort();
        $companies = Company::whereHas('jobs')->get()->pluck('name')->unique()->sort();
        $investors = Investor::whereHas('jobs')->get()->pluck('name')->unique()->sort();

        return View::make("enterprise.widgets.jobs")
            ->with([
                'jobs' => $jobs,
            ])
            ->render();
    }

    public function eventsWidget(Request $request): string
    {
        $pageFilters = $request->input('page');
        $maxResults = $pageFilters['size'] ?? 5;
        $now = Carbon::now(config('app.timezone'));

        $events = QueryBuilder::for(Event::class)
            ->where('start_date', '>=', $now)
            ->with(['companies', 'eventTypes', 'locations', 'focus'])
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
            ->paginate($maxResults)
            ->appends(request()->query());

        return View::make("enterprise.widgets.events")
            ->with([
                'events' => $events,
            ])
            ->render();
    }

    public function filters(Request $request): string
    {
        $search = $request->input('search');
        $for = $request->input('for');

        $allowedEntities = [
            'clinicaltrials' => Clinicaltrial::class,
            'patents' => Patent::class,
            'mediaItems' => MediaItem::class,
            'focus' => Focus::class
        ];

        $allowedFields = [
            'media_type'
        ];

        if ($search === 'mediaItems') {
            $query = MediaItem::enterpriseCombinedFeed();
        } else {
            $query = $allowedEntities[$search]::orderBy('name');
        }

        if (in_array($for, $allowedFields)) {
            $query = $query->orderBy($for)->pluck($for, $for);
        } else {
            $query = $query->whereHas($for)->pluck('name', 'slug');
        }

        $filterValues = array_change_key_case($query->toArray(), CASE_LOWER);

        return View::make("enterprise.widget-controls.filters.checkbox")
            ->with([
                'className' => $search . '-' . $for,
                'filterValues' => $filterValues,
            ])
            ->render();

    }
}
