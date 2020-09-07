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

        $count_companies      = Company::all()->count();
        $count_people         = Person::all()->count();
        $count_investors      = Investor::all()->count();
        $count_locations      = Location::all()->count();
        $count_clinicaltrials = Clinicaltrial::all()->count();
        $count_jobs           = Job::all()->count();

        $latest_events = Event::where('start_date', '>=', Carbon::now('America/Chicago'))
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();
        $jobs          = Job::orderBy('posted_date', 'desc')->take(3)->get();
        $news_articles = NewsArticle::orderBy('date', 'desc')->take(3)->get();
        $metas         = Metas::fromPage($request->path());

        return view('content.homepage.index', compact(
        	'count_companies',
        	'count_people',
        	'count_investors',
        	'count_locations',
            'count_clinicaltrials',
            'count_jobs',
        	'latest_events',
        	'jobs',
            'news_articles',
            'metas'
        ));

    }
}
