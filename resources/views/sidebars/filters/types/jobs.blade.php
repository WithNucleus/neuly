@include('sidebars.filters.includes.radio-buttons', [
    'label'     => 'Employment Type',
    'name'      => 'type',
    'items'     => ['Full Time', 'Part Time'],
    'item_filters' => $filters_type
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $companies,
    'item_filters' => $filters_company_name
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Investors',
    'name'      => 'investor',
    'items'     => $investors,
    'item_filters' => $filters_investor_name
])

@include('sidebars.filters.includes.scripts')
