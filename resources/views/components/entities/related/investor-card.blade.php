<div class="col-6 col-md-4 col-lg-3 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.investors.show', $investor->slug) }}">
        <div class="logo-is-contained" style="background-image: url('{{ $investor->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
        <p class="fw-bold text-uppercase m-0">{{ $investor->name }}</p>
    </x-entities.entity-logo-card>
</div>
