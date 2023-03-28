<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $newsArticles = QueryBuilder::for(MediaItem::news()->public())
            ->with(['source'])
            ->allowedSorts([
                'name',
                'date',
            ])
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('-date')
            ->paginate(50)
            ->appends(request()->query());

        $focusCategories = Focus::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_NEWS);
        })->orderBy('name')->pluck('name')->toArray();

        $organizations = Company::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_NEWS);
        })->orderBy('name')->pluck('name')->toArray();

        return view('discover.data-feeds.news.index', compact('newsArticles', 'focusCategories', 'organizations'));
    }
}
