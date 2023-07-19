<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MediaItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $investors = [
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'investor-dustin.jpg'
            ],
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'investor-dustin.jpg'
            ],
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'investor-dustin.jpg'
            ],
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'investor-dustin.jpg'
            ],
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'investor-dustin.jpg'
            ]
        ];

        $articles = MediaItem::articles()->orderByDesc('date')->take(6)->get();
        $courses = Course::whereHas('focus')->take(8)->get();

        return view('content.home.index', [
            'investors' => $investors,
            'articles' => $articles,
            'courses' => $courses
        ]);
    }
}
