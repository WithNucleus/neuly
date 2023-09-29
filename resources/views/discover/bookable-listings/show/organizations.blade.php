<div class="row">
    <div class="col-12 col-lg-7 order-2">
        @include('discover.bookable-listings.show._website')

        @include('discover.bookable-listings.show._focus')

        @if($bookableListing->bookable->summary)
            <p>
                {{ $bookableListing->bookable->summary }}
            </p>
        @endif

        @if($bookableListing->bookable->people->count() > 0)
            <div class="row mt-5 mb-4">
                @foreach ($bookableListing->bookable->people as $person)
                    <div class="col-6 col-lg-4 text-center">
                        <a href="{{ route('discover.people.show', $person->slug) }}" class="text-decoration-none">
                            <div class="logo-square-is-contained rounded-circle"
                                         style="background-image: url('{{ $person->entityImageUrl ?? asset('images/person-blank.png') }}');">

                            </div>
                            <p>
                                <span class="d-block lead">{{ $person->name }}</span>
                                <span class="d-block text-muted">{{ $person->pivot->position }}</span>
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        @include('discover.bookable-listings.show._content')
    </div>

    <div class="col-12 col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0">
        <div class="text-center mb-4">

            @include('discover.bookable-listings.show._image')

            @include('discover.bookable-listings.show._locations')

            @include('discover.bookable-listings.show._social-media')
        </div>

        @include('discover.bookable-listings._bookable-form')
    </div>

</div>
