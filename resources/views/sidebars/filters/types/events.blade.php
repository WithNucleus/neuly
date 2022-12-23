@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Event Type',
    'name'      => 'type',
    'items'     => $event_types,
    'item_filters' => $filters_type
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $event_organizations,
    'item_filters' => $filters_company_name
])

@include('sidebars.filters.includes.scripts')
