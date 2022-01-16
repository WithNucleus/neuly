<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\DataFeed;
use App\Models\Focus;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

class PodcastController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $podcasts = QueryBuilder::for(DataFeed::podcasts()->active())
            ->allowedSorts(['name'])
            ->defaultSort('name')
            ->paginate(20)
            ->appends(request()->query());

        $focus_cats = Focus::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_PODCAST);
        })->orderBy('name')->pluck('name')->toArray();

        return view('discover.data-feeds.podcasts.index', compact('podcasts', 'focus_cats'));
    }

    public function show($slug)
    {
        $feed = DataFeed::where('slug', $slug)->with(['mediaItems' => function ($query) {
            $query->podcasts();
        }])->firstOrFail();

        $episodes = QueryBuilder::for(MediaItem::podcasts()->where('source_id', $feed->id))
            ->paginate(20)
            ->appends(request()->query());

        return view('discover.data-feeds.podcasts.episodes-list', compact('feed', 'episodes'));
    }

}
