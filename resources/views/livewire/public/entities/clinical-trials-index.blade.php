<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search clinical trials" placeholder="Search" search="{{ $search }}" />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Status</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.status" id="filter-status" :options="$statusOptions" :currentFilters="$filters['status']" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="clinicaltrials_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Age</h4>
                <x-livewire-filters.checkbox-multiple wireModel="filters.age" id="filter-age" :options="$ageGroupOptions" :currentFilters="$filters['age']" />
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
                <h4 class="h5 text-body-emphasis">Organizations</h4>
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

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Conditions</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="conditionSearch"
                    wireModelFilter="filters.conditions"
                    label="Search conditions"
                    checkboxIdPrefix="filter-condition"
                    setFilterFunction="setConditionFilter"
                    :searchResults="$conditionSearchResults"
                    :currentFilters="$filters['conditions']"
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
                <h1 class="me-4 mb-md-0 text-body-emphasis">Clinical Trials</h1>
                <div class="lead">
                    {{ $records->total() }} Clinical Trials
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Title" field="title" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                </div>
            </div>
            <div class="col-12 row">
                @forelse($records as $clinicalTrial)
                    <div wire:key="{{ $clinicalTrial->slug }}" class="col-12 col-md-6 mb-4">
                        <x-entities.related.clinical-trial-card :clinicalTrial="$clinicalTrial" classes="col-12 h-100" />
                    </div>

                @empty
                    <div wire:key="empty" class="w-100">
                        <p class="lead mb-0">
                            No clinical trials match your search criteria.
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
