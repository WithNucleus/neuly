<div class="col-6 col-md-4 col-xl-3 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $subsidiary->slug) }}" linkClasses="py-2">
        <div class="logo-is-contained mb-1" style="background-image: url('{{ $subsidiary->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
        <p class="fw-bold text-uppercase m-0">{{ $subsidiary->name }}</p>
    </x-entities.entity-logo-card>
</div>
