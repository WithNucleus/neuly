<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Http\Controllers\Controller;
use App\Models\DataFeed;
use App\Models\MediaItem;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $books = QueryBuilder::for(MediaItem::books())
            ->allowedSorts(['name'])
            ->defaultSort('name')
            ->paginate(15)
            ->appends(request()->query());

        return view('discover.data-feeds.books.index', compact('books'));
    }

}
