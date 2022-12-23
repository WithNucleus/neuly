@if(isset($filters) && !empty($filters))
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
        @foreach($filters as $filterType => $filterData)
            @include('sidebars.filters.types.' . $filterType, ['data' => $filterData])
        @endforeach
    </div>
</div>
@endif

@include('sidebars.filters.scripts')
