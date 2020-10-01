<nav id="sidebar-nav" class="clearfix">

    <button onClick="clearFilters()" class="float-right btn btn-link p-1 text-decoration-none regular-font">
        <small class="clear-filters"><i class="fad fa-times-circle"></i> Clear All Filters</small>
    </button>

    <div class="title d-lg-none">
        <button class="btn btn-sm btn-dark" id="toggleFilterSidebar" type="button" data-toggle="collapse" data-target="#filterSidebar" aria-controls="filterSidebar" aria-expanded="true" aria-label="Toggle Filters">
            Toggle Filters
        </button>
    </div>

    <div class="sidebar-sticky collapse py-2 px-0" id="filterSidebar">
        <div class="row">

            @if(Route::is('embeds.jobs.index'))

                <div class="col-lg-4">
                    @include('sidebars.filters.radio-buttons', [
                        'label'     => 'Employment Type',
                        'name'      => 'type',
                        'items'     => ['Full Time', 'Part Time'],
                        'item_filters' => $filters_type
                    ])
                </div>
                <div class="col-lg-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Location',
                        'name'      => 'locations',
                        'items'     => $locations,
                        'item_filters' => $filters_location,
                    ])
                </div>
                <div class="col-lg-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Organization',
                        'name'      => 'company',
                        'items'     => $companies,
                        'item_filters' => $filters_company_name
                    ])
                </div>

                @include('sidebars.filters.scripts')

            @endif

            @if(Route::is('embeds.events.index'))
                @include('sidebars.events')
            @endif

        </div>
    </div>
</nav>
