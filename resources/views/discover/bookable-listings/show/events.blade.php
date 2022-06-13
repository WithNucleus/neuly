<div class="row">
    <div class="col-12 col-lg-7 order-2">
        @include('discover.bookable-listings.show._website')

        @include('discover.bookable-listings.show._focus')

        <div class="event-details">
            <p class="lead mb-2">
                <span class="sr-only">Date:</span>
                @if($bookableListing->start_date)
                    {{ Carbon\Carbon::parse($bookableListing->start_date)->format('M d, Y') }}
                    @if($bookableListing->bookable->end_date)
                        - {{ Carbon\Carbon::parse($bookableListing->end_date)->format('M d, Y') }}
                    @endif
                @else
                    {{ Carbon\Carbon::parse($bookableListing->bookable->start_date)->format('M d, Y') }}
                    @if($bookableListing->bookable->end_date)
                        - {{ Carbon\Carbon::parse($bookableListing->bookable->end_date)->format('M d, Y') }}
                    @endif
                @endif
            </p>
        </div>

        @if($bookableListing->bookable->summary != '')
            <p>
                {{ $bookableListing->bookable->summary }}
            </p>
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
