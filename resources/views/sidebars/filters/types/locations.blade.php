@include('sidebars.filters.includes.locations', [
    'label' => 'Search',
    'filters_location' => $filters_location,
    'actionUrl' => route('searchassets.locationsRegions')
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Countries',
    'name'      => 'countries',
    'items'     => $countries,
    'item_filters' => $filters_countries
])

@include('sidebars.filters.includes.scripts')
