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
use App\ChartWidgets;

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

        // Get Primary Object Counts
        $count_companies = Company::all()->count();
        $count_people = Person::all()->count();
        $count_investors = Investor::all()->count();
        $count_locations = Location::all()->count();
        $count_clinicaltrials = Clinicaltrial::all()->count();

        // Get 3 Latest Events
        $latest_events = Event::where('start_date', '>=', Carbon::now('America/Chicago'))
                        ->orderBy('start_date', 'asc')
                        ->take(3)
                        ->get();

        // Get Recent Job Postings
        $jobs = Job::orderBy('posted_date', 'desc')->take(3)->get();

        // Get 3 Latest News Articles
        $news_articles = NewsArticle::orderBy('date', 'desc')->take(3)->get();

        // Metas
        $metas = Metas::fromPage($request->path());

        // Company Type Chart
        $company_type_chart = ChartWidgets::companyTypeChart();

        // Top 10 Locations
        $top_ten_locations_list = ChartWidgets::topTenLocations();

        // Return View
        return view('content.homepage.index', compact(
        	'count_companies', 
        	'count_people', 
        	'count_investors', 
        	'count_locations',
            'count_clinicaltrials',
        	'latest_events',
        	'jobs',
            'news_articles',
            'metas',
            'company_type_chart',
            'top_ten_locations_list'
        ));

    }
}
