<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;

class RelatedEntitiesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.import.related-entities.index');
    }
}
