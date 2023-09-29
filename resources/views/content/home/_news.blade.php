<div class="home-news bg-body-secondary">
    <div class="container text-center">
        <h2 class="h1 text-body-emphasis">From News to Neuly</h2>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach($articles as  $article)
                <div class="col-12 col-md-6 text-start my-3">
                    <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer" class="card-hover-drop">
                        <div class="bg-body h-100 p-3 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 d-none d-lg-block me-lg-3">
                                        <img src="{{ $article->source->entity_image_url ?? asset('images/image-placeholder-article.png') }}" alt="{{ $article->source->name }}" class="img-height-80">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="text-small mb-2 text-body">
                                            Written by {{ $article->source->name }} &bull; {{ \Carbon\Carbon::parse($article->date)->diffForHumans() }}
                                        </div>
                                        <h3 class="h6 text-body-emphasis">{{ $article->name }}</h3>
                                    </div>
                                </div>
                                <div class="text-body mt-1">
                                    <p class="mb-0">{{ $article->short_summary }}</p>
                                </div>
                            </div>
                            @if($article->focus->count() > 0)
                                <div class="d-flex flex-wrap mt-2">
                                    @foreach($article->focus as $focus)
                                        <span class="badge bg-body-tertiary text-body me-1">{{ $focus->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('discover.articles') }}" class="btn btn-cta btn-primary btn-lg">Read More Articles</a>
        </div>
    </div>
</div>
