<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <div class="d-flex align-items-center">
                <input wire:model="search" type="text" class="form-control me-2" placeholder="Search" aria-label="Search companies">
                <span>
                    <i class="fa-sharp fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Search by name, keyword, location, focus..."></i>
                </span>
            </div>


            <div class="small mt-2">
                @if($search)
                    <span class="me-1">Searching for:</span>
                    <strong>{{ $search }}</strong>
                    <button wire:click="clearSearch" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                @endif
            </div>

            <div class="my-4">
                <div class="form-check lead">
                    <input wire:model="filters.now-hiring" class="form-check-input" type="checkbox" value="true" id="now-hiring">
                    <label class="form-check-label" for="now-hiring">
                        Now Hiring
                    </label>
                </div>
                <div class="form-check lead">
                    <input wire:model="filters.upcoming-events" class="form-check-input" type="checkbox" value="true" id="upcoming-events">
                    <label class="form-check-label" for="upcoming-events">
                        Upcoming Events
                    </label>
                </div>
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                @foreach ($typeOptions as $typeOption)
                    <div class="form-check">
                        <input wire:model="filters.type" class="form-check-input" type="checkbox" value="{{ $typeOption }}" id="filter-type-{{ $typeOption }}" @if(in_array($typeOption, $filters['type'])) checked @endif>
                        <label class="form-check-label" for="filter-type-{{ $typeOption }}">
                            {{ $typeOption }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Location</h4>
                <form
                    x-data='{
                        locationSelected(e) {
                            let value = e.target.value
                            Livewire.emit("updateSearchLocation", value);
                        }
                    }'
                >
                    <input
                        aria-label="Search locations"
                        type="text"
                        list="locationSearchOptions"
                        wire:model="locationSearch"
                        class="form-control"
                        x-on:change.debounce="locationSelected($event)"
                        placeholder="Search locations"
                        id="location-search-box"
                    >

                    <datalist id="locationSearchOptions">
                        @foreach($locationSearchResults as $result)
                            <option
                                wire:key="{{ $result['id'] }}"
                                data-value="{{ $result['id'] }}"
                                value="{{ $result['name'] }}"
                            ></option>
                        @endforeach
                    </datalist>
                </form>
                <div>
                    @if($filters['locations'])
                        @foreach($filters['locations'] as $location)
                            <div class="form-check my-2">
                                <input wire:model="filters.locations" class="form-check-input" type="checkbox" value="{{ $location }}" id="filter-locations-{{ $location }}" @if(in_array($location, $filters['locations'])) checked @endif>
                                <label class="form-check-label" for="filter-locations-{{ $location }}">
                                    {{ $location }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                @foreach ($focusDrugOptions as $option)
                    <div class="form-check">
                        <input wire:model="filters.focus" class="form-check-input" type="checkbox" value="{{ $option['name'] }}" id="filter-focus-{{ $option['name'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                        <label class="form-check-label" for="filter-focus-{{ $option['name'] }}">
                            {{ $option['name'] }} <span class="text-secondary small">({{ $option['companies_count'] }})</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Industry</h4>
                @foreach ($focusOtherOptions as $option)
                    <div class="form-check">
                        <input wire:model="filters.industry" class="form-check-input" type="checkbox" value="{{ $option['name'] }}" id="filter-industry-{{ $option['name'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                        <label class="form-check-label" for="filter-industry-{{ $option['name'] }}">
                            {{ $option['name'] }} <span class="text-secondary small">({{ $option['companies_count'] }})</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end mb-3">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Organizations</h1>
                <div class="lead">
                    {{ $records->total() }} Organizations
                </div>
            </div>
            <div class="col-12 mb-3">
                <div>
                    <x-entities.entity-index-sort-button label="Company Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Investors" field="investors_count" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Events" field="events_count" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Jobs" field="jobs_count" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $company)
                <div class="col-12 col-md-6 col-xl-4 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $company->slug) }}" linkClasses="py-5">
                        @if($company->jobs_count > 0)
                            <span class="position-top-left ms-1 lead">
                                <span class="badge bg-success"><i class="fa-sharp fa-solid fa-briefcase me-1"></i>HIRING</span>
                            </span>
                        @endif

                        <div class="logo-is-contained" style="background-image: url('{{ $company->entityImageUrl }}')"></div>
                        <p class="my-3 h5 px-1">{{ $company->name }}</p>

                        <div class="text-body-emphasis fw-bold text-uppercase my-3">{{ $company->ownership ?? 'Unknown Type' }}</div>

                        <div class="text-primary-emphasis">
                            @forelse ($company->focus as $item)
                                {{ $item->name }}@if (!$loop->last) &bull; @endif
                            @empty
                                <em>Unlisted Focus</em>
                            @endforelse
                        </div>
                        <div class="d-flex justify-content-center align-items-center lead">
                            @if($company->jobs_count > 0)
                                <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $company->jobs_count }} {{ $company->jobs_count > 1 ? 'Jobs' : 'Job' }}</span>
                            @endif
                            @if($company->events_count > 0)
                                <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $company->events_count }} {{ $company->events_count > 1 ? 'Events' : 'Event' }}</span>
                            @endif
                        </div>
                    </x-entities.entity-logo-card>
                </div>

            @empty
                <div class="w-100">
                    <p class="lead mb-0">
                        No companies match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

    <script>
        window.addEventListener('clearLocationSearchBox', event => {
            console.log("clear it please!");
            document.getElementById('location-search-box').value = "";
            document.getElementById("locationSearchOptions").innerHTML = "";
        });
    </script>

</div>
