<?php

namespace App\Http\Controllers\Adminx\Import;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'import');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.import.courses.index');
    }
}
