@if ($bookableListing->content->count() > 0)
    <div>
        @foreach ($bookableListing->content as $content)
            <div class="mb-3">
                <p class="lead-smaller mb-0 text-muted">{{ $content->name }}</p>
                {!! $content->formattedContent !!}
            </div>
        @endforeach
    </div>
@endif

@if ($bookableListing->bookable_type == \App\Models\Company::class OR $bookableListing->bookable_type == \App\Models\Person::class)

    @if ($bookableListing->bookable->content->count() > 0)
        <div>
            @foreach ($bookableListing->bookable->content as $content)
                <div class="mb-3">
                    <p class="lead-smaller mb-0 text-muted">{{ $content->name }}</p>
                    {!! $content->formattedContent !!}
                </div>
            @endforeach
        </div>
    @endif

@endif
