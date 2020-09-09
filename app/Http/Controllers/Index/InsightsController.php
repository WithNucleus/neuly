<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;

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
    	return view('discover.insights.index');
    }
}
