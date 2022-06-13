<div class="row">
    <div class="col-12 col-lg-7 order-2">
        @include('discover.bookable-listings.show._website')
        @include('discover.bookable-listings.show._focus')

        @if($bookableListing->bookable->bio)
            <div class="mb-3">
                {!! $bookableListing->bookable->bio !!}
            </div>
        @endif

        @include('discover.bookable-listings.show._content')
    </div>

    <div class="col-12 col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0">
        <div class="text-center mb-4">
            <div class="person-photo-large mb-3" style="background-image: url('{{ ($bookableListing->image) ?? $bookableListing->bookableImage }}');"></div>

            @include('discover.bookable-listings.show._locations')

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
        </div>

        @include('discover.bookable-listings._bookable-form')
    </div>

</div>
