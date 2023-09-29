<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search Jobs" placeholder="Search" search="{{ $search }}" />

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
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusDrugOptions" :currentFilters="$filters['focus']" countName="jobs_count" />
            </div>
            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Industry</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.industry" id="filter-industry" :options="$focusOtherOptions" :currentFilters="$filters['focus']" countName="jobs_count" />
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
                    <x-entities.entity-index-sort-button label="Last Updated" field="updated_at" :sorts="$sorts" />
                </div>
            </div>
            @forelse($records as $job)
                <div wire:key="{{ $job->slug }}" class="col-12 col-md-6 col-xxl-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.jobs.show', $job->slug) }}" linkClasses="py-2 d-flex flex-column justify-content-between">
                        <div class="flex-grow-1">
                            <div class="logo-is-contained" style="background-image: url('{{ $job->owner->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
                            <p class="my-3 h5 px-1 text-success">{{ $job->name }}</p>

                            @if($job->focus->count() > 0)
                                <div class="d-flex flex-wrap justify-content-center align-items-center lead">
                                    @foreach($job->focus as $focus)
                                        <span class="mx-2 mt-2 badge bg-body-tertiary text-body-emphasis">{{ $focus->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="d-md-flex justify-content-between px-2">
                            <div class="text-body-secondary fw-bold text-uppercase mt-3">{{ $job->employment_type ?? 'Unknown Type' }}</div>
                            <div class="text-body-secondary fw-bold text-uppercase mt-3">{{ $job->pretty_posted_date }}</div>
                        </div>
                    </x-entities.entity-logo-card>
                </div>

            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No jobs match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
