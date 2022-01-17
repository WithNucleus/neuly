@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Type',
    'name'      => 'type',
    'items'     => $types,
    'item_filters' => $filters_type
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Education Credits',
    'name'      => 'education_credits',
    'items'     => ['CE', 'CME', 'CPD'],
    'item_filters' => $filter_education_credits
])

@include('sidebars.filters.scripts')
