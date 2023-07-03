<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search Companies" placeholder="Search" search="{{ $search }}" />

            <div class="my-4">
                <x-livewire-filters.checkbox-single wireModel="filters.now-hiring" id="filter-now-hiring" label="Now Hiring" />
                <x-livewire-filters.checkbox-single wireModel="filters.upcoming-events" id="filter-upcoming-events" label="Upcoming Events" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" />
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
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="companies_count" />
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Industry</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.industry" id="filter-industry" :options="$focusOtherOptions" :currentFilters="$filters['focus']" countName="companies_count" />
            </div>
            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Organizations</h1>
                <div class="lead">
                    {{ $records->total() }} Organizations
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Company Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Investors" field="investors_count" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Events" field="events_count" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Jobs" field="jobs_count" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $company)
                <div wire:key="{{ $company->slug }}" class="col-12 col-md-6 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $company->slug) }}" linkClasses="py-5">
                        @if($company->jobs_count > 0)
                            <span class="position-top-left ms-1 lead">
                                <span class="badge bg-success"><i class="fa-sharp fa-solid fa-briefcase me-1"></i>HIRING</span>
                            </span>
                        @endif

                        <div class="logo-is-contained" style="background-image: url('{{ $company->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
                        <p class="my-3 h5 px-1 text-success">{{ $company->name }}</p>

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
                <div wire:key="empty" class="w-100">
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

</div>
