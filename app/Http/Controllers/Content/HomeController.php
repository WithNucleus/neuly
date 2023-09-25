<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MediaItem;
use App\Models\Research;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $investors = [
            [
                'name' => 'Dustin Robinson',
                'title' => 'Investor',
                'image' => 'dustin-robinson.jpg'
            ],
            [
                'name' => 'Michelle Weiner',
                'title' => 'Therapist',
                'image' => 'michelle-weiner.jpg'
            ],
            [
                'name' => 'Josh Hardman',
                'title' => 'Researcher',
                'image' => 'josh-hardman.jpg'
            ],
            [
                'name' => 'Damien Kettlewell',
                'title' => 'Founder',
                'image' => 'damien-kettlewell.jpg'
            ],
            [
                'name' => 'Christian Gray',
                'title' => 'Consultant',
                'image' => 'christian-gray.jpg'
            ]
        ];

        $articles = MediaItem::articles()->orderByDesc('date')->take(6)->get();
        $courses = Course::featured()->take(8)->get();
        $research = Research::whereNotNull('abstract')->orderByDesc('created_at')->whereHas('focus')->take(4)->get();

        return view('content.home.index', [
            'investors' => $investors,
            'articles' => $articles,
            'courses' => $courses,
            'research' => $research
        ]);
    }
}
