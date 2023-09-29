<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search Research" placeholder="Search" search="{{ $search }}" />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="research_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Authors</h4>
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
                <h4 class="h5 text-body-emphasis">Publishers</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="companySearch"
                    wireModelFilter="filters.companies"
                    label="Search organizations"
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
                <h1 class="me-4 mb-md-0 text-body-emphasis">Research Papers</h1>
                <div class="lead">
                    {{ number_format($records->total()) }} Papers
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $research)
                <div wire:key="{{ $research->slug }}" class="col-12 col-lg-6 col-xxl-4 mb-4">
                    <x-entities.show.research-card :research="$research" />
                </div>

            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No research items match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
