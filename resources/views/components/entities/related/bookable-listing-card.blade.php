<div class="col-12 col-md-6 col-xl-4 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.bookable-listing.show', $bookableListing->slug) }}" linkClasses="py-3">
        <div class="fw-bold text-uppercase m-0">{{ $bookableListing->name }}</div>
        <div class="text-body m-0 w-100">
            <div>
                {!! $bookableListing->fullAddress !!}
            </div>
            <div>{{ $bookableListing->phone }}</div>
        </div>
    </x-entities.entity-logo-card>
</div>
