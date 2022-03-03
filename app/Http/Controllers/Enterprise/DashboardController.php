<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\FollowList;
use App\Models\MediaItem;
use App\Models\MemberNote;
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
        $queryFilters = $request->input('page');
        $maxResults = $queryFilters['size'] ?? 15;

        $feed = QueryBuilder::for(MediaItem::class)
            ->enterpriseCombinedFeed()
            ->public()
            ->with(['focus'])
            ->allowedFilters([
                'name',
                AllowedFilter::partial('focus', 'focus.name'),
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

    private function getTeam($user) {
        $team = null;

        if ($user->hasRole('Team owner')) {
            $team = $user->ownedTeam()->with(['members', 'invitations'])->first();
        } elseif ($user->hasRole('Team member')) {
            $team = $user->team()->with(['members', 'owner'])->first();
        }

        return $team;
    }
}
