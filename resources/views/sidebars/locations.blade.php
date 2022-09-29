@include('sidebars.filters.locations', [
    'label' => 'Search',
    'filters_location' => $filters_location,
    'actionUrl' => route('searchassets.locationsRegions')
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Countries',
    'name'      => 'countries',
    'items'     => $countries,
    'item_filters' => $filters_countries
])

@include('sidebars.filters.scripts')
