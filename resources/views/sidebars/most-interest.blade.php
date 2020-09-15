@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Companies',
    'name'      => 'company',
    'items'     => $company_cats,
    'item_filters' => $filters_companies
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $location_cats,
    'item_filters' => $filters_locations
])


@include('sidebars.filters.scripts')
