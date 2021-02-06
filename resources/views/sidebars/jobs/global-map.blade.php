<div class="map-type-filters">
    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Focus',
        'name'      => 'focus',
        'items'     => $focus,
        'item_filters' => $filters_focus
    ])
</div>

@include('sidebars.filters.scripts')
