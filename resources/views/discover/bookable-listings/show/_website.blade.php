@if($bookableListing->url)
    <p class="mb-2 lead">
        <a href="{{ $bookableListing->url }}" target="_blank" rel="noopener noreferrer">{{ $bookableListing->url }}</a>
    </p>
@else
    @if($bookableListing->bookable->website)
        <p class="mb-2 lead">
            <a href="{{ $bookableListing->bookable->website }}" target="_blank" rel="noopener noreferrer">{{ $bookableListing->bookable->website }}</a>
        </p>
    @endif
@endif
