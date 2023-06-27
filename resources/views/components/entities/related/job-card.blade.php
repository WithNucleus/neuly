<div class="col-12 col-lg-6 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.jobs.show', $job->slug) }}" linkClasses="py-2">
        <p class="text-start fw-bold text-uppercase m-0">{{ $job->name }}</p>
        <p class="text-start text-body-secondary m-0">
            {{ $job->pretty_posted_date }}
            &bull;
            {{ $job->employment_type }}
        </p>
    </x-entities.entity-logo-card>
</div>
