@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focusCategories,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $organizations,
    'item_filters' => $filters_company_name
])

@include('sidebars.filters.scripts')
