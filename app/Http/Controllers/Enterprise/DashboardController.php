<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\FollowList;
use App\Models\MediaItem;
use App\Models\MemberNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class DashboardController extends Controller
{
    public function index() {
        $user = auth()->user();

//        $notes = $this->getUserNotes($user->id);
//        $followLists = $this->getFollowsList($user->id);
//        $follows = $this->getFollows($user->id);
//        $team =  $this->getTeam($user);
//        $recently_viewed = $this->getRecentlyViewed($user->id);

        return view('enterprise.dashboard', compact(
            'user',
//            'notes',
//            'followLists',
//            'follows',
//            'team',
//            'recently_viewed',
        ));
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
            ->with("feed", $feed)
            ->render();
    }

    private function getUserNotes($userId) {
        return MemberNote::where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getFollowsList($userId) {
        return FollowList::with('followItems')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    private function getFollows($userId) {
        return Follow::with('followable')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
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

    private function getRecentlyViewed($userId) {

        $lastActivityIdsByType = Activity::select(DB::raw('MAX(id) AS id, MAX(created_at) AS created_at'))
            ->where('causer_id', $userId)
            ->where('causer_type', 'App\User')
            ->where('log_name', 'pageview')
            ->groupBy(['subject_id', 'subject_type'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->pluck('id')
            ->all();

        return Activity::whereIn('id', $lastActivityIdsByType)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
