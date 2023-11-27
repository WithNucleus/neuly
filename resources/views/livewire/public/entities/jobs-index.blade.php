<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search Jobs" placeholder="Search" search="{{ $search }}" />

            <div class="my-4">
                <x-livewire-filters.checkbox-single wireModel="filters.remote" id="filter-remote" label="Remote / Virtual" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Type</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.type" id="filter-type" :options="$typeOptions" :currentFilters="$filters['type']" countName="jobs_count" />
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
                <h4 class="h5 text-body-emphasis">Employer</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="ownerSearch"
                    wireModelFilter="filters.owners"
                    label="Search organizations"
                    checkboxIdPrefix="filter-owners"
                    setFilterFunction="setOwnerFilter"
                    :searchResults="$ownerSearchResults"
                    :currentFilters="$filters['owners']"
                />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="jobs_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Industry</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.industry" id="filter-industry" :options="$focusOtherOptions" :currentFilters="$filters['focus']" countName="jobs_count" />
            </div>

            <div class="my-4">
                <label for="filter-status" class="h5 text-body-emphasis">Job Status</label>
                <select wire:model="filters.status" id="filter-status" class="form-select w-auto">
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Jobs</h1>
                <div class="lead">
                    {{ $records->total() }} Jobs
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Job Title" field="job_title" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date Posted" field="posted_date" :sorts="$sorts" />
                </div>
            </div>
            <div class="col-12">
                @forelse($records as $job)
                    <div wire:key="{{ $job->slug }}" class="max-width-1300 mb-4">
                        <x-entities.related.job-card :job="$job" />
                    </div>

                @empty
                    <div wire:key="empty" class="w-100">
                        <p class="lead mb-0">
                            No jobs match your search criteria.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-center my-5 max-width-1000">
            {{ $records->links() }}
        </div>
    </div>

</div>
