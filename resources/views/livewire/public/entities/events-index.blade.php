<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search events" placeholder="Search" search="{{ $search }}" tooltip="Search by name, keyword, location, person..." />

            <div class="my-4">
                <x-livewire-filters.checkbox-single wireModel="filters.upcoming" id="filter-upcoming" label="Hide Past Events" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" />
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
            @forelse($records as $event)
                <div wire:key="{{ $event->slug }}" class="col-12 col-md-6 col-xl-4 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.events.show', $event->slug) }}" linkClasses="py-2 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-primary h6 mb-3 text-uppercase">{{ $event->pretty_start_date }}</div>
                            <div class="logo-is-contained" style="background-image: url('{{ $event->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
                            <p class="my-3 h5 px-2 text-success">{{ $event->name }}</p>
                        </div>
                        <div>
                            @if($event->focus->count() > 0)
                                <div class="d-flex flex-wrap justify-content-center align-items-center lead">
                                    @foreach($event->focus as $focus)
                                        <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $focus->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($event->eventTypes->count() > 0)
                                <div class="d-flex flex-wrap justify-content-center align-items-center lead">
                                    @foreach($event->eventTypes as $eventType)
                                        <span class="mx-2 mt-3">{{ $eventType->name }}</span>
                                    @endforeach
                                </div>
                            @endif
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

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
