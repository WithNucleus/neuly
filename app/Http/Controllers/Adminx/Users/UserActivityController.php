<?php

namespace App\Http\Controllers\Adminx\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UserActivityController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'users');
    }

    public function feedback(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.misc.feedback');
    }

    public function searchLogs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.misc.search-logs');
    }
}
