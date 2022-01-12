<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Http\Controllers\Controller;
use App\Models\Contracts\MediaTypesContract;
use App\Models\Focus;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $books = QueryBuilder::for(MediaItem::books()->public())
            ->with(['focus'])
            ->allowedSorts(['name', 'date'])
            ->defaultSort('-date')
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
            ])
            ->paginate(15)
            ->appends(request()->query());

        $focus_cats = Focus::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypesContract::MEDIA_TYPE_BOOK);
        })->orderBy('name')->pluck('name')->toArray();

        return view('discover.data-feeds.books.index', compact('books', 'focus_cats'));
    }

}
