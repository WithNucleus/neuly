@include('sidebars.filters.typeahead', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $filters_companies,
    'action'    => route('searchassets.clinicalTrialCollaborators')
])

@include('sidebars.filters.typeahead', [
    'label'     => 'Researchers',
    'name'      => 'researchers',
    'items'     => $filters_researchers,
    'action'    => route('searchassets.clinicalTrialResearchers')
])

@include('sidebars.filters.typeahead', [
    'label'     => 'Conditions',
    'name'      => 'conditions',
    'items'     => $filters_conditions,
    'action'    => route('searchassets.clinicalTrialConditions')
])

@include('sidebars.filters.typeahead', [
    'label'     => 'Interventions',
    'name'      => 'interventions',
    'items'     => $filters_interventions,
    'action'    => route('searchassets.clinicalTrialInterventions')
])

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
