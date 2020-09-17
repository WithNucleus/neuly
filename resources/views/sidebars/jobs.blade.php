@include('sidebars.filters.radio-buttons', [
    'label'     => 'Employment Type',
    'name'      => 'type',
    'items'     => ['Full Time', 'Part Time'],
    'item_filters' => $filters_type
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $companies,
    'item_filters' => $filters_company_name
])

@include('sidebars.filters.scripts')
