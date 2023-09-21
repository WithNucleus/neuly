<div class="entity-index-listings">
    <div class="d-lg-flex justify-content-center">
        <div class="max-width-300 flex-grow-1 mb-4 me-5">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name / keyword" />
        </div>
        <div class="max-width-500 mb-4">
            <div class="btn-group">
                <button wire:click="showAll" class="btn @if($filters['show-treatments'] OR $filters['show-categories']) btn-outline-primary @else btn-primary @endif rounded-0">Show All</button>

                <button wire:click="showTreatments" class="btn @if($filters['show-treatments']) btn-primary @else btn-outline-primary @endif rounded-0">Treatments</button>

                <button wire:click="showCategories" class="btn @if($filters['show-categories']) btn-primary @else btn-outline-primary @endif rounded-0">Categories</button>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($records as $record)
            <div wire:key="{{ $record->slug }}" class="col-12 col-sm-6 col-lg-4 col-lg-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.focus.show', $record->slug) }}" linkClasses="py-5">
                    <h3 class="text-success">{{ $record->name }}</h3>
                    <div class="text-uppercase text-body-secondary">
                        {{ $record->type ? 'Treatment' : 'Category' }}
                    </div>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </div>
</div>
