<div class="map-type-filters">
    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Type',
        'name'      => 'type',
        'items'     => ['Privately Held', 'Public Company', 'Non-Profit', 'Educational Institution', 'Government Agency'],
        'item_filters' => $filters_type
    ])

    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Focus',
        'name'      => 'focus',
        'items'     => $focus_cats,
        'item_filters' => $filters_focus
    ])
</div>

@include('sidebars.filters.scripts')
