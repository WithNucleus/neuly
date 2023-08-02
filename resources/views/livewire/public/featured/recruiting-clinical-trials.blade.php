<div class="entity-index-listings">
    <div>
        <input wire:model="searchLocation.name" id="locationName" type="hidden">
        <input wire:model="searchLocation.latitude" id="locationLatitude" type="hidden">
        <input wire:model="searchLocation.longitude" id="locationLongitude" type="hidden">
    </div>
    <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center">
        <div class="filter-widget d-flex align-items-center me-md-4 mb-3">
            <input wire:model.lazy="search" type="text" class="form-control me-2" placeholder="Search by keyword" aria-label="Search listings">
            <span>
                <i class="fa-sharp fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Search by name, location, specialty, condition, etc."></i>
            </span>
        </div>

        <div class="filter-widget me-md-4 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['focus']) btn-accent @else btn-primary @endif dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    I'm interested in
                </button>
                <ul class="dropdown-menu" style="min-width: 200px">
                    @foreach ($focusOptions as $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.focus" class="form-check-input" type="checkbox" value="{{ $option['name'] }}"
                                       id="filter-focus-{{ $option['slug'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                                <label class="form-check-label @if(in_array($option['name'], $filters['focus'])) fw-bold @endif" for="filter-focus-{{ $option['slug'] }}">
                                    {{ $option['name'] }} ({{ $option['recruiting_clinical_trials_count'] }})
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="filter-widget me-md-4 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['gender']) btn-accent @else btn-primary @endif dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    By Gender
                </button>
                <ul class="dropdown-menu" style="min-width: 200px">
                    @foreach ($genderOptions as $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.gender" class="form-check-input" type="checkbox" value="{{ $option->gender }}"
                                       id="filter-gender-{{ $option->gender }}" @if(in_array($option->gender, $filters['gender'])) checked @endif>
                                <label class="form-check-label @if(in_array($option->gender, $filters['gender'])) fw-bold @endif" for="filter-gender-{{ $option->gender }}">
                                    {{ $option->gender }} ({{ $option->count }})
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        @forelse($records as $record)
            <div wire:key="{{ $record->id }}" class="col-12 col-lg-6 mb-4">
                <div wire:click="goListing('{{ $record->id }}')" class="card h-100">
                    <div class="card-body text-center d-flex justify-content-center align-items-stretch card-hover">
                        <div class="text-decoration-none w-100 px-2 pt-4 pb-0">
                            <div class="d-flex flex-column justify-content-between h-100 position-relative">
                                <div>
                                    <h3 class="h5 text-success mb-0">{{ $record->title }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div wire:key="empty" class="w-100">
                <div class="h4 text-transform-none text-center">
                    No clinical trials match your search criteria.
                </div>
            </div>
        @endforelse
    </div>

</div>
