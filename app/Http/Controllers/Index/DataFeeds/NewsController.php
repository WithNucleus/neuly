<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.data-feeds.news.index');
    }
}
