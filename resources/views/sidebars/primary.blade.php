{{-- @include('navbars.tabs-mobile') --}}

<nav id="sidebar-nav" class="col-lg-3 col-xl-2 bg-light sidebar">

    <div class="title clearfix">
        <div class="h3 border-bottom pb-2">
            Filters

            <button onClick="clearFilters()" class="float-right btn btn-link p-1 text-decoration-none regular-font">
                <small class="clear-filters"><i class="fad fa-times-circle"></i> Clear All</small>
            </button>
        </div>

    </div>

    <div class="title d-lg-none">
        <button class="btn btn-sm btn-dark" id="toggleFilterSidebar" type="button" data-toggle="collapse" data-target="#filterSidebar" aria-controls="filterSidebar" aria-expanded="true" aria-label="Toggle Filters">
            Toggle Filters
        </button>
    </div>

    <div class="sidebar-sticky collapse" id="filterSidebar">
        <div class="flex-column pb-4">

            @if(Route::is('discover.organizations') OR Route::is('discover.organizations.show'))
                @include('sidebars.companies')
            @endif

            @if(Route::is('discover.focus') OR Route::is('discover.focus.show'))
                @include('sidebars.focus')
            @endif

            @if(Route::is('discover.investors') OR Route::is('discover.investors.show'))
                @include('sidebars.investors')
            @endif

            @if(Route::is('discover.research') OR Route::is('discover.research.show'))
                @include('sidebars.research')
            @endif

            @if(Route::is('discover.locations') OR Route::is('discover.locations.show'))
                @include('sidebars.locations')
            @endif

            @if(Route::is('discover.people') OR Route::is('discover.people.show'))
                @include('sidebars.people')
            @endif

            @if(Route::is('discover.jobs') OR Route::is('discover.jobs.show'))
                @include('sidebars.jobs')
            @endif

            @if(Route::is('discover.clinicaltrials') OR Route::is('discover.clinicaltrials.show'))
                @include('sidebars.clinicaltrial')
            @endif

            @if(Route::is('discover.events') OR Route::is('discover.events.show') OR Route::is('discover.events.past'))
                @include('sidebars.events')
            @endif

            @if(Route::is('insights.collaborators.show'))
                @include('sidebars.collaborators')
            @endif

                @if(Route::is('insights.most-interest.show'))
                    @include('sidebars.most-interest')
                @endif

        </div>
    </div>
</nav>
