<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\DataFeed;
use App\Models\Focus;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $videos = QueryBuilder::for(MediaItem::videos()->public())
            ->with(['source'])
            ->allowedSorts([
                'name',
                'date'
            ])
            ->defaultSort('-date')
            ->paginate(20)
            ->appends(request()->query());

        $focus_cats = Focus::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_VIDEO);
        })->orderBy('name')->pluck('name')->toArray();

        return view('discover.data-feeds.videos.index', compact('videos', 'focus_cats'));
    }
}
