<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobsController extends Controller
{
    public function index()
    {
        $data = Job::all();

        return response()->json($data);
    }
}
