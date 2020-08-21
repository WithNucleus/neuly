<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\BookmarkList;
use App\Models\Bookmark;
use App\Models\MemberNote;
use Auth;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
	// Member Dashboard Page
    public function index() {

        // If Not Logged In - Show Dashboard Benefits
        if (!Auth::check()) {
            return view('members.dashboard-loggedout');
        }

        $recently_viewed = Activity::where('causer_id', Auth::id())
                ->where('causer_type', 'App\User')
                ->where('log_name', 'pageview')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

    	$lists = BookmarkList::where('user_id', Auth::id())
    			->orderBy('name', 'asc')
    			->take(3)
    			->get();

    	$bookmarks = Bookmark::where('user_id', Auth::id())
				->orderBy('created_at', 'desc')
				->take(3)
				->get();

        $notes = MemberNote::where('user_id', Auth::id())
                ->orderBy('updated_at', 'desc')
                ->take(5)
                ->get();

        $follows = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

    	return view('members.dashboard', compact('lists', 'bookmarks', 'notes', 'recently_viewed', 'follows'));

    }
}
