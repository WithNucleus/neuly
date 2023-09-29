<?php

namespace App\Http\Controllers\Adminx\Care;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BookableListingController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'care');
    }

    public function bookableListingRequests(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.care.bookable-listings.requests');
    }
}
