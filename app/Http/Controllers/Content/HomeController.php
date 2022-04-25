<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Job;
use App\Models\Clinicaltrial;
use App\Services\Metas;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Homepage
    public function index(Request $request)
    {

        $latest_events = Event::where('start_date', '>=', Carbon::now('America/Chicago'))
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();
        $jobs = Job::where('status', Job::STATUS_OPEN)->orderBy('posted_date', 'desc')->take(3)->get();
        $news_articles = MediaItem::news()->public()->orderBy('date', 'desc')->take(3)->get();
        $metas = Metas::fromPage($request->path());
        $count_recruiting_trials = Clinicaltrial::where('status', 'Recruiting')->count();

        return view('content.homepage.index', compact(
            'count_recruiting_trials',
            'latest_events',
            'jobs',
            'news_articles',
            'metas'
        ));

    }
}
