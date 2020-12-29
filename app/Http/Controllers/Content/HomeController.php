<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Person;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Event;
use App\Models\Job;
use App\Models\Clinicaltrial;
use App\Models\NewsArticle;
use App\Services\Metas;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
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
    }

    // Homepage
    public function index(Request $request) {

        $latest_events = Event::where('start_date', '>=', Carbon::now('America/Chicago'))
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();
        $jobs          = Job::orderBy('posted_date', 'desc')->take(3)->get();
        $news_articles = NewsArticle::orderBy('date', 'desc')->take(3)->get();
        $metas         = Metas::fromPage($request->path());
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
