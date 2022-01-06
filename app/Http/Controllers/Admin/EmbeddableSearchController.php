<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EmbeddableSearchController extends Controller
{
    public function index()
    {
        return view('admin.embeddable-search');
    }
}
