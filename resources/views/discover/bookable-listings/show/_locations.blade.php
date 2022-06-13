<div class="location-details mb-3">
    <a href="{{ $bookableListing->googleMapUrl }}">{!! $bookableListing->fullAddress !!}</a>

    @if(!empty($bookableListing->phone))
        <div class="phone-details mt-1">
            <a href="tel:{{ $bookableListing->phone }}">{{ $bookableListing->phone }}</a>
        </div>
    @endif
</div>
