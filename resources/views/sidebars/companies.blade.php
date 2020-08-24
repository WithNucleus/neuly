<div class="filter-checkbox-container mb-3" aria-label="Filter by additional options">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="hiring" id="hiring" value="1" @if ($filter_hiring && $filter_hiring == 1) checked @endif>
        <label class="custom-control-label lead-smaller" for="hiring">Now Hiring</label>
    </div>
</div>

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Type',
    'name'      => 'type',
    'items'     => ['Privately Held', 'Public Company', 'Non-Profit', 'Educational Institution', 'Government Agency'],
    'item_filters' => $filters_type
])

<div class="organizations-locations mb-4">
    <label for="locations" class="h4">Locations</label>
    <div class="d-flex">
        <input type="text" class="typeahead form-control" name="locations-search" placeholder="e.g. New York">
        <button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
    </div>

    <div id="locations-filter">
        <span class="d-block title"></span>

        @isset($filters_location)
            @foreach ($filters_location as $location)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="location" id="{{ $location }}" value="{{ $location }}" checked>
                    <label class="custom-control-label" for="{{ $location }}">{{ $location }}</label>
                </div>
            @endforeach
        @endisset
    </div>
</div>

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

{{-- @include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'location',
    'items'     => $locations,
    'item_filters' => $filters_location
]) --}}

@include('sidebars.filters.scripts')
