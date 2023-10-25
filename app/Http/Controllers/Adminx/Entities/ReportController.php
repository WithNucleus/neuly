<?php

namespace App\Http\Controllers\Adminx\Entities;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'entities');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.entities.reports.index');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $report = Report::findOrFail($id);
        return view('adminx.entities.reports.edit', [
            'report' => $report
        ]);
    }
}
