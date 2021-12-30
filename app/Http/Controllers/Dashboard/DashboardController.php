<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\FollowList;
use App\Models\MemberNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * @var string[]
     */
    private $defaultWidgetsOrder = [
        'following',
        'notes',
        'recent',
        'team',
    ];

    // Member Dashboard Page
    public function index()
    {
        $user = auth()->user();
        $widgetsOrder = $this->defaultWidgetsOrder;

        if ($user->dashboard_widgets_order !== null) {
            $widgetsOrder = $user->dashboard_widgets_order;
            $widgetsDiff = array_diff($this->defaultWidgetsOrder, $widgetsOrder);
            $widgetsOrder = array_merge($widgetsOrder, $widgetsDiff);
        }

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

        $notes = MemberNote::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        $team = null;

        if ($user->hasRole('Team owner')) {
            $team = $user->ownedTeam()->with(['members', 'invitations'])->first();
        } elseif ($user->hasRole('Team member')) {
            $team = $user->team()->with(['members', 'owner'])->first();
        }

        return view('members.dashboard', compact(
            'user',
            'notes',
            'recently_viewed',
            'followLists',
            'follows',
            'widgetsOrder',
            'team',
        ));
    }

    public function updateWidgetsOrder(Request $request)
    {
        $user = $request->user();
        $newWidgetsOrder = $request->input('order');

        foreach ($this->defaultWidgetsOrder as $widget) {
            if (!in_array($widget, $newWidgetsOrder)) {
                $newWidgetsOrder[] = $widget;
            }
        }

        $user->dashboard_widgets_order = $newWidgetsOrder;
        $user->save();
    }
}
