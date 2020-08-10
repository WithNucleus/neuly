<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChartWidgets;

class InsightsController extends Controller
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

    public function index() {

    	// Top 10 Locations
        $top_ten_locations_list = ChartWidgets::topTenLocations();

        // Company Type Chart
        $company_type_chart = ChartWidgets::companyTypeChart();

    	return view('discover.insights.index', compact('top_ten_locations_list', 'company_type_chart'));

    }
}
