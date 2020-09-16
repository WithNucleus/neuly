@include('sidebars.filters.radio-buttons', [
    'label'     => 'Employment Type',
    'name'      => 'type',
    'items'     => ['Full Time', 'Part Time'],
    'item_filters' => $filters_type
])

@if(isset($embed) && $embed === true)

    @include('sidebars.filters.select', [
        'label'     => 'Locations',
        'name'      => 'locations',
        'items'     => $locations,
        'item_filters' => $filters_location,
        'multi' => true,
    ])

    @include('sidebars.filters.select', [
        'label'     => 'Organizations',
        'name'      => 'company',
        'items'     => $companies,
        'item_filters' => $filters_company_name,
        'multi' => true,
    ])

@else

    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Locations',
        'name'      => 'locations',
        'items'     => $locations,
        'item_filters' => $filters_location
    ])

    @include('sidebars.filters.checkboxes-new', [
        'label'     => 'Organizations',
        'name'      => 'company',
        'items'     => $companies,
        'item_filters' => $filters_company_name
    ])

@endif

@include('sidebars.filters.scripts')
