@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focusesFilter,
    'item_filters' => isset($currentFilters['focus']) ? $currentFilters['focus'] : []
])

@include('sidebars.filters.scripts')
