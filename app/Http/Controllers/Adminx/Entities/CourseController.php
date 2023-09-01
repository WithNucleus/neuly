<?php

namespace App\Http\Controllers\Adminx\Entities;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'entities');
    }

    public function index() {
        return view('adminx.entities.courses.index');
    }
}
