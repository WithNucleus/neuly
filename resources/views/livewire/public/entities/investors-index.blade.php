<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search investors" placeholder="Search" search="{{ $search }}" tooltip="Search by name, keyword, location, person..." />

            <div class="my-4">
                <x-livewire-filters.checkbox-single wireModel="filters.now-hiring" id="filter-now-hiring" label="Now Hiring" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" />
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
                <h1 class="me-4 mb-md-0 text-body-emphasis">Investors</h1>
                <div class="lead">
                    {{ number_format($records->total()) }} Investors
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Investor Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Companies" field="companies_count" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="# of Jobs" field="jobs_count" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $investor)
                <div wire:key="{{ $investor->slug }}" class="col-12 col-md-6 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.investors.show', $investor->slug) }}" linkClasses="py-5">
                        @if($investor->jobs_count > 0)
                            <span class="position-top-left ms-1 lead">
                                <span class="badge bg-success"><i class="fa-sharp fa-solid fa-briefcase me-1"></i>HIRING</span>
                            </span>
                        @endif

                        <div class="logo-is-contained" style="background-image: url('{{ $investor->entityImageUrl ?? asset('images/image-placeholder-investor.png') }}')"></div>
                        <p class="my-3 h5 px-1 text-success">{{ $investor->name }}</p>

                        <div class="text-body-emphasis fw-bold text-uppercase my-3">{{ $investor->type ?? 'Unknown Type' }}</div>

                        <div class="d-flex justify-content-center align-items-center lead">
                            @if($investor->companies_count > 0)
                                <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $investor->companies_count }} {{ $investor->companies_count > 1 ? 'Companies' : 'Company' }}</span>
                            @endif

                            @if($investor->jobs_count > 0)
                                <span class="mx-2 mt-3 badge bg-body-tertiary text-body-emphasis">{{ $investor->jobs_count }} {{ $investor->jobs_count > 1 ? 'Jobs' : 'Job' }}</span>
                            @endif
                        </div>
                    </x-entities.entity-logo-card>
                </div>

            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No investors match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
