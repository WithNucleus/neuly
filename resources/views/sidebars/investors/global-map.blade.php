<div class="map-type-filters">
    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Type',
        'name'      => 'type',
        'items'     => $type_cats,
        'item_filters' => $filtered_types
    ])
</div>

@include('sidebars.filters.scripts')
