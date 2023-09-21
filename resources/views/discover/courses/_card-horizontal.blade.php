<div wire:click="goListing('{{ $record->id }}')" class="neuly-edu-course-item bg-body">
    <div class="image">
        <div>
            <img src="{{ $record->companies->first()->entityImageUrl ?? asset('images/image-placeholder-edu.png') }}"
                alt="{{ $record->name }}" class="entity-square-image mb-3">
            <div class="text-uppercase fw-bold text-body-secondary text-center">{{ $record->companies->first()->name ?? '' }}</div>
        </div>
        <div>
            @if ($record->education_credits)
                <div class="lead mt-3">
                    <span class="badge bg-primary-subtle text-primary-emphasis">
                        {{ $record->education_credits }}
                    </span>
                </div>
            @endif
        </div>
    </div>
    <div class="text">
        <div>
            <h2 class="h4 text-success">{{ $record->name }}</h2>
            @if($record->next_date)
                <div class="my-2 lead text-uppercase text-body-emphasis">
                    <strong>Next
                        date:</strong> {{ \Carbon\Carbon::parse($record->next_date)->format('M d, Y') }}
                </div>
            @endif
            @if($record->focus->count() > 0)
                <p class="fw-bold mb-2 text-body-secondary text-uppercase">
                    @foreach ($record->focus as $item)
                        {{ $item->name }}
                        @if (!$loop->last)/@endif
                    @endforeach
                </p>
            @endif
            <div class="text-start w-100">{{ $record->short_summary }}</div>
        </div>
        <div class="d-md-flex justify-content-between mt-3 text-primary text-uppercase fw-bold">
            <div class="text-start me-4">{{ $record->type }}</div>
            <div class="text-end">{{ $record->formattedCost }}</div>
        </div>
    </div>
</div>
