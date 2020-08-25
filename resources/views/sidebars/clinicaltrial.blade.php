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

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

{{-- @include('sidebars.filters.location', ['column' => '3']) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Organization',
	'placeholder' 	=> 'e.g. 920 Coalition',
	'prefetch' 		=> 'organization/names.json',
	'column' 		=> 4
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Collaborator',
	'placeholder' 	=> 'e.g. Allergan',
	'prefetch' 		=> 'people/names.json',
	'column' 		=> 4
]) --}}

{{-- @include('sidebars.filters.focus', ['column' => '2']) --}}


@include('sidebars.filters.scripts')
