<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;

class CourseController extends Controller
{

    public function index()
    {
        return view('discover.courses.index');
    }
}
