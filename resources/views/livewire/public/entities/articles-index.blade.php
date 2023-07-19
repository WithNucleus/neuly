<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search articles" placeholder="Search" search="{{ $search }}" tooltip="Search by keyword, organization, person..." />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusOptions" :currentFilters="$filters['focus']" countName="articles_count" />
            </div>

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Publisher</h4>
                <x-livewire-filters.faux-multi-select
                    wireModelSearch="sourceSearch"
                    wireModelFilter="filters.sources"
                    label="Search people"
                    checkboxIdPrefix="filter-source"
                    setFilterFunction="setSourceFilter"
                    :searchResults="$sourceSearchResults"
                    :currentFilters="$filters['sources']"
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

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Articles</h1>
                <div class="lead">
                    {{ $records->total() }} Articles
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date" field="date" :sorts="$sorts" />
                </div>
            </div>
        </div>
        <div>
            @forelse($records as $record)
                <livewire:public.entities.show.news-article-widget :record="$record" :wire:key="$record->slug" />
            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No articles match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
