<div class="map-type-filters">
    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Type',
        'name'      => 'type',
        'items'     => $type_cats,
        'item_filters' => $filtered_types
    ])

    @include('sidebars.filters.radio-buttons', [
        'label'     => 'Hiring?',
        'name'      => 'hiring',
        'items'     => ['Yes', 'No', 'Both'],
        'item_filters' => $filters_hiring,
        'inline' => true
    ])
</div>

@include('sidebars.filters.scripts')
