{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Person', 
	'placeholder' 	=> 'e.g. Aaron Johnson', 
	'prefetch' 		=> 'people/names.json',
	'column' 		=> 0
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Organization', 
	'placeholder' 	=> 'e.g. 920 Coalition', 
	'prefetch' 		=> 'organization/names.json',
	'column' 		=> 1
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Investor', 
	'placeholder' 	=> 'e.g. Tabula Rasa Ventures', 
	'prefetch' 		=> 'investor/names.json',
	'column' 		=> 2
]) --}}

{{-- @include('sidebars.filters.location', ['column' => '3']) --}}

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'location',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.scripts')