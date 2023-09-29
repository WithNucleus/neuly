<?php

namespace App\Http\Controllers\Adminx\Research;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ResearchController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'research');
    }

    public function researchRequests(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.research.research-requests.index');
    }
}
