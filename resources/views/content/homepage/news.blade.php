<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h2">Top 3 Trending News</h3>
        <div>
            @foreach ($news_articles as $newsArticle)
                <div class="p-2 mt-1 @if(!$loop->last) border-bottom @endif">
                    <p class="lead mb-0">
                        <a href="{{ $newsArticle->url }}" target="_blank" rel="noopener noreferrer" title="{{ $newsArticle->name }}">{{ $newsArticle->name }}</a>
                    </p>
                    <p class="my-1">
                        <strong>{{ \Carbon\Carbon::parse($newsArticle->date)->format('M d, Y') }}</strong>
                        @if ($newsArticle->summary != '')
                        &ndash; {{ $newsArticle->summary }}
                        @endif
                    </p>
                    @if($newsArticle->focus->count() > 0)
                        <p class="text-secondarydark my-1">
                            <i class="fad fa-flask"></i>
                            @foreach ($newsArticle->focus as $item)
                                {{ $item->name }}@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer bg-none text-center">
        <a href="{{ route('discover.news') }}" class="btn btn-dark">Browse All News</a>
    </div>
</div>
