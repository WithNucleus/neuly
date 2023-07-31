<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;

class RecruitingClinicalTrialController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.recruiting-trials.index');
    }
}
