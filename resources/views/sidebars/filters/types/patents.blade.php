@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focusCategories,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Status',
    'name'      => 'status',
    'items'     => $patentStatuses,
    'item_filters' => $filters_status
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $organizations,
    'item_filters' => $filters_company_name
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'People',
    'name'      => 'people',
    'items'     => $people,
    'item_filters' => $filters_person_name
])

@include('sidebars.filters.includes.scripts')
