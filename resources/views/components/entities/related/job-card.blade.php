<div class="col-12 col-lg-6 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.jobs.show', $job->slug) }}" linkClasses="py-2 text-start">
        <p class="lead fw-bold text-uppercase text-body-emphasis m-0">{{ $job->name }}</p>
        @if($withOwner)
            <p class="fw-bold text-uppercase text-body-secondary mb-1">{{ $job->owner->name }}</p>
        @endif
        <p class="text-body-secondary m-0">
            {{ $job->pretty_posted_date }}
            &bull;
            {{ $job->employment_type }}
        </p>
    </x-entities.entity-logo-card>
</div>
