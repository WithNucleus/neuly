@include('sidebars.filters.typeahead', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $filters_organizations,
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

@include('sidebars.filters.typeahead', [
    'label'     => 'Outcome Measures',
    'name'      => 'outcome_measures',
    'items'     => $filters_outcome_measures,
    'action'    => route('searchassets.clinicalTrialOutcomeMeasures')
])

@include('sidebars.filters.typeahead', [
    'label'     => 'Study Designs',
    'name'      => 'study_designs',
    'items'     => $filters_study_designs,
    'action'    => route('searchassets.clinicalTrialStudyDesigns')
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Status',
    'name'      => 'status',
    'items'     => $status,
    'item_filters' => $filters_status
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Phase',
    'name'      => 'phase',
    'items'     => $phases,
    'item_filters' => $filters_phases
])

@include('sidebars.filters.scripts')
