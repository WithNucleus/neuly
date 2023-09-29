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
                <button type="button" class="btn btn-md @if($filters['focus']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    I'm interested in
                </button>
                <ul class="dropdown-menu" style="min-width: 200px">
                    @foreach ($focusOptions as $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.focus" class="form-check-input" type="checkbox" value="{{ $option['name'] }}"
                                       id="filter-focus-{{ $option['slug'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                                <label class="form-check-label @if(in_array($option['name'], $filters['focus'])) fw-bold @endif" for="filter-focus-{{ $option['slug'] }}">
                                    {{ $option['name'] }} ({{ $option['bookable_listings_count'] }})
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="filter-widget me-md-4 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['type']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    I'm looking for
                </button>
                <ul class="dropdown-menu" style="min-width: 200px">
                    @foreach ($typeOptions as $optionId => $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.type" class="form-check-input" type="checkbox" value="{{ $option }}"
                                       id="filter-type-{{ $optionId }}" @if(in_array($option, $filters['type'])) checked @endif>
                                <label class="form-check-label @if(in_array($option, $filters['type'])) fw-bold @endif" for="filter-type-{{ $optionId }}">
                                    {{ $option }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="filter-widget mb-3">
            <div class="form-check lead">
                <input wire:model="telehealth" class="form-check-input" type="checkbox" id="filter-telehealth">
                <label class="form-check-label" for="filter-telehealth">
                    Telehealth / Virtual
                </label>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap" style="min-height: 40px">
        @if($search)
            <div class="me-3 mb-3">
                <span>{{ $search }}</span>
                <button wire:click="clearSearch" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
            </div>
        @endif
        @foreach($filters['focus'] as $id => $focus)
            <div class="me-3 mb-3">
                <span>{{ $focus }}</span>
                <button wire:click="clearFilter('focus', '{{ $id }}')" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
            </div>
        @endforeach
        @foreach($filters['type'] as $id => $type)
            <div class="me-3 mb-3">
                <span>{{ $type }}</span>
                <button wire:click="clearFilter('type', '{{ $id }}')" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
            </div>
        @endforeach
        @if($localLocation['name'])
            <div class="me-3 mb-3">
                <span>{{ $localLocation['name'] }}</span>
                <button wire:click="clearLocalLocation" class="btn text-danger px-1 border-0" aria-label="Clear location"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
            </div>
        @endif
        @if($searchLocation['name'])
            <div class="me-3 mb-3">
                <span>{{ $searchLocation['name'] }}</span>
                <button wire:click="clearSearchLocation" class="btn text-danger px-1 border-0" aria-label="Clear location"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
            </div>
        @endif
        <div class="filter-widget ms-auto mt-3">
            <button wire:click="clearFilters" class="btn btn-sm btn-ghost-primary">Clear Filters</button>
        </div>
    </div>
    <div class="row mt-4">
        @forelse($records as $record)
            <div wire:key="{{ $record->id }}" class="col-12 col-lg-6 col-xxl-4 mb-4">
                <div wire:click="goListing('{{ $record->id }}')" class="card h-100">
                    <div class="card-body text-center d-flex justify-content-center align-items-stretch card-hover">
                        <div class="text-decoration-none w-100 px-2 pt-4 pb-0">
                            <div class="d-flex flex-column justify-content-between h-100 position-relative">
                                <div>
                                    @if($record->virtual === 1)
                                        <div class="h4 mb-0 text-accent position-top-right">
                                            <i class="fa-sharp fa-solid fa-phone-plus"></i>
                                        </div>
                                    @endif
                                    @if ($record->bookable_type == \App\Models\Person::class)
                                        <div class="logo-square-is-contained rounded-circle"
                                         style="background-image: url('{{ $record->image ?? asset('images/person-blank.png') }}');">
                                            <span class="visually-hidden">{{ $record->name }}</span>
                                        </div>
                                    @else
                                        <div class="logo-is-contained"
                                         style="background-image: url('{{ $record->image ?? asset('images/image-placeholder.jpg') }}');">
                                            <span class="visually-hidden">{{ $record->name }}</span>
                                        </div>
                                    @endif
                                    <div class="mt-3">
                                        <h3 class="h5 text-success mb-0">{{ $record->name }}</h3>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex flex-wrap align-items-center justify-content-center lead text-uppercase">
                                        @foreach($record->focusDrugs as $focus)
                                            <span class="me-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $focus->name }}</span>
                                        @endforeach
                                    </div>

                                    <address class="my-3 lead text-uppercase fw-bold text-body-secondary">
                                        @if($record->location)
                                            <div>{{ $record->location->name }}</div>
                                        @else
                                            @if ($record->location_name)
                                                <div>{{ $record->location_name }}</div>
                                            @endif
                                        @endif
                                    </address>

                                    @if ($record->start_date)
                                        <div class="my-4">
                                            {{ \Carbon\Carbon::parse($record->start_date)->format('M d') }}
                                            @if ($record->end_date)
                                                &ndash; {{ \Carbon\Carbon::parse($record->end_date)->format('M d') }}
                                            @endif
                                        </div>
                                    @endif

                                    <div class="mt-3 d-md-flex justify-content-between">
                                        <div class="text-uppercase">{{ ucwords($record->type) }}</div>
                                        <div>
                                            @if($localLocation['name'])
                                                <span wire:key="distance-local">{{ number_format($record->distance, 0) }} miles</span>
                                            @elseif($searchLocation['name'])
                                                <span wire:key="distance-saved">{{ number_format($record->distance, 0) }} miles</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div wire:key="empty" class="w-100">
                <div class="h4 text-transform-none text-center">
                    No care practitioners match your search criteria.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center my-5">
        {{ $records->links() }}
    </div>

</div>
