<div wire:click="goListing('{{ $record->id }}')" class="neuly-edu-course-item-vertical bg-body">
    <div class="top">
        <div class="image @isset($record->companies->first()->entityImageUrl) bg-body @else bg-primary @endif"
             style="background-image: url('{{ $record->companies->first()->entityImageUrl ?? asset('images/image-placeholder-edu.png') }}')"></div>

        <h2 class="h4 text-success">{{ $record->name }}</h2>

        <div class="text-uppercase fs-5 fw-bold text-body mb-3">{{ $record->companies->first()->name ?? '' }}</div>

        @if($record->focus->count() > 0)
            <p class="fw-bold fs-6 mb-2 text-body-secondary text-uppercase">
                @foreach ($record->focus as $item)
                    {{ $item->name }}
                    @if (!$loop->last)/@endif
                @endforeach
            </p>
        @endif

        <div class="text-start text-body-secondary w-100">{{ $record->very_short_summary }}</div>

    </div>
    <div class="bottom mt-auto">
        <div class="d-md-flex justify-content-between align-items-end text-uppercase">
            <div>
                @if($record->next_date)
                    <div class="mt-3 text-body-emphasis">
                        <strong>Next date:</strong> {{ \Carbon\Carbon::parse($record->next_date)->format('M d') }}
                    </div>
                @endif
            </div>
            <div>
                @if ($record->education_credits)
                    <div class="fs-6 mt-3">
                        <span class="badge bg-primary-subtle text-primary-emphasis">
                            {{ $record->education_credits }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-md-flex justify-content-between align-items-end mt-3 text-primary text-uppercase fw-bold">
            <div class="text-start me-4">{{ $record->type }}</div>
            <div class="text-end">{{ $record->formattedCost }}</div>
        </div>
    </div>
</div>
