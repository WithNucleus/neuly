<div class="entity-index-listings row">
    <div class="col-12">
        <div class="max-width-300 mx-auto mb-4">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name / keyword" />
        </div>
    </div>
    @foreach($records as $record)
        <div wire:key="{{ $record->slug }}" class="col-12 col-sm-6 col-lg-4 col-lg-3 mb-4">
            <x-entities.entity-logo-card url="{{ route('discover.focus.show', $record->slug) }}" linkClasses="py-5">
                <h3 class="text-success">{{ $record->name }}</h3>
                <div class="text-uppercase text-body-secondary">
                    {{ $record->type ? 'Focus' : 'Category' }}
                </div>
            </x-entities.entity-logo-card>
        </div>
    @endforeach
</div>
