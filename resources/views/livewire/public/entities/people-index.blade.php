<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search People" placeholder="Search" search="{{ $search }}" />

            <div class="my-4">
                <x-livewire-filters.checkbox-single wireModel="filters.upcoming-events" id="filter-upcoming-events" label="Upcoming Events" />
                <x-livewire-filters.checkbox-single wireModel="filters.has-research" id="filter-has-research" label="Has Research" />
                <x-livewire-filters.checkbox-single wireModel="filters.has-clinical-trials" id="filter-has-clinical-trials" label="Clinical Trials" />
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

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="people_count" />
            </div>

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end mb-3">
                <h1 class="me-4 mb-md-0 text-body-emphasis">People</h1>
                <div class="lead">
                    {{ $records->total() }} People
                </div>
            </div>
            <div class="col-12 mb-3">
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Events" field="events_count" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $person)
                <div wire:key="{{ $person->slug }}" class="col-12 col-md-6 col-xl-4 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.people.show', $person->slug) }}" linkClasses="py-5">
                        @if($person->events_count > 0)
                            <span class="position-top-left ms-1 lead">
                                <span class="badge bg-success"><i class="fa-sharp fa-solid fa-calendar me-1"></i>EVENTS</span>
                            </span>
                        @endif

                        <div class="logo-square-is-contained rounded-circle mb-3" style="background-image: url('{{ $person->entityImageUrl ?? asset('images/person-blank.png') }}')"></div>
                        <p class="my-3 h5 px-1 text-success">{{ $person->name }}</p>

                        <div class="text-body-emphasis fw-bold text-uppercase my-3">{{ $person->byline }}</div>

                        <div class="text-primary-emphasis">
                            @foreach ($person->focus as $item)
                                {{ $item->name }}@if (!$loop->last) &bull; @endif
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center align-items-center lead">
                            @if($person->events_count > 0)
                                <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $person->events_count }} {{ $person->events_count > 1 ? 'Events' : 'Event' }}</span>
                            @endif
                        </div>
                    </x-entities.entity-logo-card>
                </div>

            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No people match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
