<?php

namespace App\Http\Controllers\Adminx\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class MiscController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'misc');
    }

    public function feedback(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.misc.feedback');
    }
}
