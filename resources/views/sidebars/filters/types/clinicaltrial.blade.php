@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $filters_companies,
    'action'    => route('searchassets.clinicalTrialCollaborators')
])

@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Researchers',
    'name'      => 'researchers',
    'items'     => $filters_researchers,
    'action'    => route('searchassets.clinicalTrialResearchers')
])

@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Conditions',
    'name'      => 'conditions',
    'items'     => $filters_conditions,
    'action'    => route('searchassets.clinicalTrialConditions')
])

@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Interventions',
    'name'      => 'interventions',
    'items'     => $filters_interventions,
    'action'    => route('searchassets.clinicalTrialInterventions')
])

@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Outcome Measures',
    'name'      => 'outcome_measures',
    'items'     => $filters_outcome_measures,
    'action'    => route('searchassets.clinicalTrialOutcomeMeasures')
])

@include('sidebars.filters.includes.typeahead', [
    'label'     => 'Study Designs',
    'name'      => 'study_designs',
    'items'     => $filters_study_designs,
    'action'    => route('searchassets.clinicalTrialStudyDesigns')
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Status',
    'name'      => 'status',
    'items'     => $status,
    'item_filters' => $filters_status
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Year',
    'name'      => 'year',
    'items'     => $years,
    'item_filters' => $filters_year
])


