<div class="d-flex flex-wrap align-items-center justify-content-center">
    @if ($bookableListing->bookable->linkedin)
        <a href="{{ $bookableListing->bookable->linkedin }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-linkedin fa-2x"></i></a>
    @endif
    @if ($bookableListing->bookable->instagram)
        <a href="{{ $bookableListing->bookable->instagram }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-instagram fa-2x"></i></a>
    @endif
    @if ($bookableListing->bookable->facebook)
        <a href="{{ $bookableListing->bookable->facebook }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-facebook fa-2x"></i></a>
    @endif
</div>
