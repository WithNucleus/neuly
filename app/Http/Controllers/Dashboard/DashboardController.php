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
        // If Not Logged In - show Dashboard preview
        if (!Auth::check()) {
            return view('members.dashboard-loggedout');
        }

        // Recently Viewed Items
        $recently_viewed = Activity::where('causer_id', Auth::id())
                ->where('causer_type', 'App\User')
                ->where('log_name', 'pageview')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

    	// Get Lists
    	$lists = BookmarkList::where('user_id', Auth::id())
    			->orderBy('name', 'asc')
    			->take(3)
    			->get();

    	// Get Latest Bookmarks
    	$bookmarks = Bookmark::where('user_id', Auth::id())
				->orderBy('created_at', 'desc')
				->take(3)
				->get();

        // Get Latest Notes
        $notes = MemberNote::where('user_id', Auth::id())
                ->orderBy('updated_at', 'desc')
                ->take(5)
                ->get();

        $follows = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

    	// Return View
    	return view('members.dashboard', compact('lists', 'bookmarks', 'notes', 'recently_viewed', 'follows'));

    }
}
