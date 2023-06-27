<div class="col-12 col-lg-6 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}" linkClasses="py-1 text-start">
        <p class="fs-6 fw-bold text-uppercase m-0">{{ $clinicalTrial->name }}</p>
        @if($clinicalTrial->conditions->count() > 0)
            <div class="fs-6 mt-2 mb-3 text-body">
                @foreach ($clinicalTrial->conditions as $item)
                    <div>{{ $item->value }}</div>
                @endforeach
            </div>
        @endif
        <div class="d-flex justify-content-start text-body-secondary mb-3">
            @foreach ($clinicalTrial->focus as $focus)
                <span class="badge bg-secondary text-uppercase">{{ $focus->name }}</span>
            @endforeach
        </div>
        <div class="text-body-secondary d-flex flex-wrap">
            <div class="me-3">
                <strong>Start Date:</strong> {{ $clinicalTrial->pretty_start_date }}
            </div>
            <div>
                <strong>Last Updated:</strong> {{ $clinicalTrial->pretty_last_update_posted }}
            </div>
        </div>
    </x-entities.entity-logo-card>
</div>
