<nav id="sidebar-nav" class="col-12 clearfix">

    <button onClick="clearFilters()" class="float-right btn btn-link p-1 text-decoration-none regular-font">
        <small class="clear-filters"><i class="fad fa-times-circle"></i> Clear All Filters</small>
    </button>

    <div class="title d-lg-none">
        <button class="btn btn-sm btn-dark" id="toggleFilterSidebar" type="button" data-toggle="collapse" data-target="#filterSidebar" aria-controls="filterSidebar" aria-expanded="true" aria-label="Toggle Filters">
            Toggle Filters
        </button>
    </div>

    <div class="sidebar-sticky collapse" id="filterSidebar">
        <div class="flex-column pb-4">

            @if(Route::is('embeds.jobs.index'))
                @include('sidebars.jobs')
            @endif

            @if(Route::is('embeds.events.index'))
                @include('sidebars.events')
            @endif

        </div>
    </div>
</nav>
