<div class="card shadow-sm mb-5">
    <div class="card-body">
        <h3 class="h2">Top 3 Trending News</h3>
        <div>
            @foreach ($news_articles as $article)
                <div class="p-2 mt-1 @if(!$loop->last) border-bottom @endif">
                    @if($loop->iteration == 1)
                        <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer">
                            <div class="news-featured-image rounded shadow-sm mb-1" style="background-image: url('/storage/{{ $article->image }}');"></div>
                            <p class="lead mb-0">{{ $article->name }}</p>
                        </a>
                    @else
                        <p class="lead mb-0">
                            <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer" title="{{ $article->name }}">{{ $article->name }}</a>
                        </p>
                    @endif
                    <p class="mb-0">
                        <span class="text-muted"><i class="fad fa-calendar"></i></span>
                        <strong>{{ \Carbon\Carbon::parse($article->date)->format('M d, Y') }}</strong>
                    </p>
                    <p class="mb-0">
                        <span class="text-success"><i class="fad fa-at"></i></span>
                        {{ $article->publisher }}
                    </p>
                    @if ($article->focus->count() > 0)
                        <p class="mb-0">
                            <span class="text-secondary"><i class="fad fa-flask"></i></span>
                            @foreach($article->focus as $item)
                                {{ $item->name }}@if (!$loop->last),@endif
                            @endforeach
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
