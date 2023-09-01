<?php

namespace App\Http\Controllers\Adminx\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClinicalTrialsController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'import');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.import.clinical-trials.index');
    }

    public function import(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.import.clinical-trials.import');
    }
}
