<div class="{{ $classes ?? 'col-12 col-lg-6 mb-4' }}">
    <x-entities.entity-logo-card url="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}" linkClasses="py-1 text-start">
        <p class="fs-6 fw-bold m-0">{{ $clinicalTrial->name }}</p>
        <div class="h6 mt-2 text-uppercase text-body fw-bold">
            {{ $clinicalTrial->status }}
        </div>
        @if($clinicalTrial->conditions->count() > 0)
            <div class="mt-2 mb-2 text-body-emphasis">
                @foreach ($clinicalTrial->conditions as $item)
                    <div>{{ $item->value }}</div>
                @endforeach
            </div>
        @endif
        <div class="text-body-secondary d-flex flex-wrap">
            <div class="me-3">
                <strong>Start Date:</strong> {{ $clinicalTrial->pretty_start_date }}
            </div>
            <div>
                <strong>Last Updated:</strong> {{ $clinicalTrial->pretty_last_update_posted }}
            </div>
        </div>
        @if($clinicalTrial->locations->count() > 0)
            <div class="mt-2 text-body-secondary">
                @foreach ($clinicalTrial->locations as $location)
                    <span>
                        <span>{{ $location->name }}</span>
                        @if (!$loop->last)
                            @if ($loop->iteration == 3)
                                <span>and {{ $clinicalTrial->locations->count() - $loop->iteration }} more</span>
                                @break
                            @else
                                <span class="mx-1 text-body-tertiary">/</span>
                            @endif
                        @endif
                    </span>
                @endforeach
            </div>
        @endif
        <div class="d-flex flex-wrap justify-content-start mt-3">
            @foreach ($clinicalTrial->focus as $focus)
                <span class="badge bg-body-secondary text-body text-uppercase me-2">{{ $focus->name }}</span>
            @endforeach
        </div>
    </x-entities.entity-logo-card>
</div>
