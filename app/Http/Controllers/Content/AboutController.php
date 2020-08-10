<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Metas;
use App\ChartWidgets;

class AboutController extends Controller
{

    public function index(Request $request) {

    	// Metas
        $metas = Metas::fromPage($request->path());

        // Company Type Chart
        $company_type_chart = ChartWidgets::companyTypeChart();

    	return view('content.about.index', compact('metas', 'company_type_chart'));

    }
}
