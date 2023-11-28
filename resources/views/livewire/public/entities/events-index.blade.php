<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search events" placeholder="Search" search="{{ $search }}" tooltip="Search by name, keyword, location, person..." />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Date</h4>
                <div class="d-xl-flex align-items-center">
                    <input wire:model="filters.start_date" type="date" class="form-control form-control-sm rounded-0">
                    <span class="px-1">to</span>
                    <input wire:model="filters.end_date" type="date" class="form-control form-control-sm rounded-0">
                </div>
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" countName="events_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="events_count" />
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Industry</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.industry" id="filter-industry" :options="$focusOtherOptions" :currentFilters="$filters['focus']" countName="events_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">People</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="personSearch"
                    wireModelFilter="filters.people"
                    label="Search people"
                    checkboxIdPrefix="filter-person"
                    setFilterFunction="setPersonFilter"
                    :searchResults="$personSearchResults"
                    :currentFilters="$filters['people']"
                />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Location</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="locationSearch"
                    wireModelFilter="filters.locations"
                    label="Search locations"
                    checkboxIdPrefix="filter-location"
                    setFilterFunction="setLocationFilter"
                    :searchResults="$locationSearchResults"
                    :currentFilters="$filters['locations']"
                />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Companies</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="companySearch"
                    wireModelFilter="filters.companies"
                    label="Search companies"
                    checkboxIdPrefix="filter-company"
                    setFilterFunction="setCompanyFilter"
                    :searchResults="$companySearchResults"
                    :currentFilters="$filters['companies']"
                />
            </div>
            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Events</h1>
                <div class="lead">
                    {{ number_format($records->total()) }} Events
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date" field="start_date" :sorts="$sorts" />
                </div>
            </div>
            <div class="col-12">
                @forelse($records as $event)
                    <div wire:key="{{ $event->slug }}" class="mb-4 max-width-1000">
                        <x-entities.entity-logo-card url="{{ route('discover.events.show', $event->slug) }}" linkClasses="py-2 text-start" cardClasses="border-0" cardBodyClasses="bg-body-tertiary border-0">
                            <div class="d-lg-flex align-items-start">
                                <div class="flex-shrink-0 me-lg-4 mb-3 mb-lg-0 text-lg-center event-index-image-container">
                                    <div class="medium-square-card bg-white border">
                                        <div class="logo-is-contained" style="background-image: url('{{ $event->entityImageUrl ?? asset('images/image-placeholder-event.png') }}')"></div>
                                    </div>
                                    <div class="h6 text-uppercase fw-bold mt-2">
                                        {{ $event->pretty_start_date }}
                                    </div>
                                </div>
                                <div class="text-content flex-grow-1 d-flex flex-column justify-content-between">
                                    <div class="h4 text-success">{{ $event->name }}</div>

                                    @if($event->eventTypes->count() > 0)
                                        <div class="fs-6">
                                            @foreach($event->eventTypes as $eventType)
                                                <span class="text-primary">{{ $eventType->name }}</span>
                                                @if(!$loop->last) <span class="mx-1">/</span> @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($event->locations->count() > 0)
                                        <div class="mt-2 text-body-emphasis">
                                            <span>{{ $event->locations->first()->name }}</span>
                                            @if($event->locations->count() > 1)
                                                <span class="text-body-secondary small">(and more)</span>
                                            @endif
                                        </div>
                                    @endif

                                    @if($event->focus->count() > 0)
                                        <div class="d-flex flex-wrap lead">
                                            @foreach($event->focus as $focus)
                                                <span class="mt-3 badge bg-body-secondary text-body me-3">{{ $focus->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </x-entities.entity-logo-card>
                    </div>

                @empty
                    <div wire:key="empty" class="w-100">
                        <p class="lead mb-0">
                            No events match your search criteria.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
