<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.reports.index');
    }

    public function show($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $report = Report::where('slug', $slug)->firstOrFail();
        return view('discover.reports.show', [
            'report' => $report
        ]);
    }
}
