<div class="filter-checkbox-container mb-3" aria-label="Filter by additional options">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="hiring" id="hiring" value="1" @if ($filter_hiring && $filter_hiring == 1) checked @endif>
        <label class="custom-control-label lead-smaller" for="hiring">Now Hiring</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="upcoming_events" id="upcoming_events" value="1" @if ($filter_upcoming_events && $filter_upcoming_events == 1) checked @endif>
        <label class="custom-control-label lead-smaller" for="upcoming_events">Upcoming Events</label>
    </div>
</div>

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Type',
    'name'      => 'type',
    'items'     => ['Privately Held', 'Public Company', 'Non-Profit', 'Educational Institution', 'Government Agency'],
    'item_filters' => $filters_type
])

@include('sidebars.filters.includes.locations', [
    'label' => 'Locations',
    'filters_location' => $filters_location,
    'actionUrl' => route('searchassets.companiesLocations'),
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

{{-- @include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'location',
    'items'     => $locations,
    'item_filters' => $filters_location
]) --}}

@include('sidebars.filters.includes.scripts')
