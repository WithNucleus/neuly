<div class="map-type-filters">
    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Status',
        'name'      => 'status',
        'items'     => $status,
        'item_filters' => $filters_status
    ])

    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Focus',
        'name'      => 'focus',
        'items'     => $focus_cats,
        'item_filters' => $filters_focus
    ])
</div>

@include('sidebars.filters.scripts')
