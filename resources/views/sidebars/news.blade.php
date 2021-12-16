@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focusCategories,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.scripts')
