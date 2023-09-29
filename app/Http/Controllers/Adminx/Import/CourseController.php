<?php

namespace App\Http\Controllers\Adminx\Import;

use App\Http\Controllers\Controller;
use App\Models\ImportResult;
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

    public function results(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.import.courses.results');
    }

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $importResult = ImportResult::findOrFail($id);
        return view('adminx.import.courses.show', [
            'importResult' => $importResult
        ]);
    }
}
