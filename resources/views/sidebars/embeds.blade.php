<nav id="sidebar-nav" class="clearfix pt-2">

    <button onClick="clearFilters()" class="float-right btn btn-link p-1 text-decoration-none regular-font">
        <small class="clear-filters"><i class="fad fa-times-circle"></i> Clear All Filters</small>
    </button>

    <div class="title d-lg-none">
        <button class="btn btn-sm btn-dark mt-2 mb-2" id="toggleFilterSidebar" type="button" data-toggle="collapse" data-target="#filterSidebar" aria-controls="filterSidebar" aria-expanded="true" aria-label="Toggle Filters">
            Toggle Filters
        </button>
    </div>

    <div class="sidebar-sticky collapse pb-0 pt-2 px-0" id="filterSidebar">
        <div class="row">

            @if(Route::is('embeds.jobs.index'))

                <div class="col-6 col-lg-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Location',
                        'name'      => 'locations',
                        'items'     => $locations,
                        'item_filters' => $filters_location
                    ])
                </div>
                <div class="col-6 col-lg-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Organization',
                        'name'      => 'company',
                        'items'     => $companies,
                        'item_filters' => $filters_company_name
                    ])
                </div>
                <div class="col-12 col-lg-4">
                    @include('sidebars.filters.radio-buttons', [
                        'label'     => 'Employment Type',
                        'name'      => 'type',
                        'items'     => ['Full Time', 'Part Time'],
                        'item_filters' => $filters_type,
                        'inline' => true
                    ])
                </div>
            @endif

            @if(Route::is('embeds.events.index'))
                <div class="col-12">
                    @include('sidebars.filters.checkboxes-new', [
                        'label'     => 'Event Type',
                        'name'      => 'type',
                        'items'     => $event_types,
                        'item_filters' => $filters_type,
                        'inline' => true
                    ])
                </div>
                <div class="col-6 col-md-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Locations',
                        'name'      => 'locations',
                        'items'     => $locations,
                        'item_filters' => $filters_location,
                    ])
                </div>
                <div class="col-6 col-md-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Focus',
                        'name'      => 'focus',
                        'items'     => $focus_cats,
                        'item_filters' => $filters_focus,
                    ])
                </div>
                <div class="col-6 col-md-4">
                    @include('sidebars.filters.select', [
                        'label'     => 'Organizations',
                        'name'      => 'company',
                        'items'     => $event_organizations,
                        'item_filters' => $filters_company_name,
                    ])
                </div>
            @endif

            @include('sidebars.filters.scripts')

        </div>
    </div>
</nav>
