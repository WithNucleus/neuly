<div class="col-6 col-md-4 col-xl-3 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.people.show', $person->slug) }}" linkClasses="py-2">
        <div class="logo-square-is-contained rounded-circle mb-1" style="background-image: url('{{ $person->entityImageUrl ?? asset('images/person-blank.png') }}');"></div>
        <p class="fw-bold text-uppercase m-0">{{ $person->name }}</p>
        <p class="text-body-secondary m-0">{{ $person->pivot->position }}</p>
    </x-entities.entity-logo-card>
</div>
