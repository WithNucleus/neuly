<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\NewsArticle;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index() {

        $newsArticles = QueryBuilder::for(NewsArticle::class)
            ->allowedFilters([
                'publisher',
                AllowedFilter::partial('focus', 'focus.name'),
            ])
            ->defaultSort('-date')
            ->allowedSorts([
                'date',
            ])
            ->paginate(20)
            ->appends(request()->query());

        $focus_cats = Focus::has('newsarticles', '>' , 0)->with('newsarticles')->get()->pluck('name')->unique()->sort();

        return view('discover.news.index', compact('newsArticles', 'focus_cats'));

    }
}
