<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Http\Controllers\Controller;
use App\Models\DataFeed;
use App\Models\MediaItem;
use Spatie\QueryBuilder\QueryBuilder;

class PodcastController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.data-feeds.podcasts.index');
    }

    public function show($slug)
    {
        $feed = DataFeed::where('slug', $slug)->firstOrFail();

        $episodes = QueryBuilder::for(MediaItem::podcasts()->where('source_id', $feed->id))
            ->allowedSorts([
                'name',
                'date',
            ])
            ->defaultSort('-date')
            ->paginate(20)
            ->appends(request()->query());

        return view('discover.data-feeds.podcasts.episodes-list', compact('feed', 'episodes'));
    }
}
