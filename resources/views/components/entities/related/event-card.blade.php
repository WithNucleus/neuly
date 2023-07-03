<div class="col-6 col-md-4 col-xl-3 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.events.show', $event->slug) }}" linkClasses="py-2">
        <div class="logo-is-contained mb-1" style="background-image: url('{{ $event->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
        <p class="fw-bold text-uppercase m-0">{{ $event->name }}</p>
        <p class="text-body-secondary m-0">{{ $event->pretty_start_date }}</p>
    </x-entities.entity-logo-card>
</div>
