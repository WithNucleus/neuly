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
                'name' => 'Researchers',
                'image' => 'researchers.jpg'
            ],
            [
                'name' => 'Founders',
                'image' => 'founders.jpg'
            ],
            [
                'name' => 'Investors',
                'image' => 'investors.jpg'
            ],
            [
                'name' => 'Therapists',
                'image' => 'therapists.jpg'
            ],
            [
                'name' => 'Activists',
                'image' => 'activists.jpg'
            ]
        ];

        $articles = MediaItem::articles()->with(['source', 'focus'])->orderByDesc('date')->take(6)->get();
        $courses = Course::featured()->with(['companies', 'focus'])->take(8)->get();
        $research = Research::whereNotNull('abstract')->with(['focus'])->orderByDesc('created_at')->whereHas('focus')->take(4)->get();

        return view('content.home.index', [
            'investors' => $investors,
            'articles' => $articles,
            'courses' => $courses,
            'research' => $research
        ]);
    }
}
