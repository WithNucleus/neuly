<?php

namespace App\Http\Controllers\Adminx\Edu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EduController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'edu');
    }

    public function students() {
        return view('adminx.edu.courses.students');
    }
}
