<?php
$primary_fields = [
    'study_type' => ['type' => 'text', 'label' => 'Study type', 'type_label' => null],
    'status' => ['type' => 'text', 'label' => 'Status', 'type_label' => null],
    'study_results' => ['type' => 'text', 'label' => 'Study results', 'type_label' => null],
    // 'phases' => ['type' => 'text', 'label' => 'Phases'],
    'age' => ['type' => 'text', 'label' => 'Age', 'type_label' => null],
    'enrollment' => ['type' => 'text', 'label' => 'Enrollment', 'type_label' => 'enrollment_type'],
    'funded_bys' => ['type' => 'text', 'label' => 'Funded by', 'type_label' => null],
    'allocation' => ['type' => 'text', 'label' => 'Allocation', 'type_label' => null],
    'primary_purpose' => ['type' => 'text', 'label' => 'Primary Purpose', 'type_label' => null],
    'intervention_model' => ['type' => 'text', 'label' => 'Intervention Model', 'type_label' => null],
    'time_perspective' => ['type' => 'text', 'label' => 'Time Perspective', 'type_label' => null],
    'observational_model' => ['type' => 'text', 'label' => 'Observational Model', 'type_label' => null],
];

$secondary_fields = [
    'nct_number' => ['type' => 'text', 'label' => 'NCT Number'],
    'official_title' => ['type' => 'text', 'label' => 'Official Title'],
    'acronym' => ['type' => 'text', 'label' => 'Acronym'],
    'other_ids' => ['type' => 'text', 'label' => 'Other IDs'],
    'study_url' => ['type' => 'url', 'label' => 'Study URL']
];

$dates = [
    'start_date' => ['type' => 'date', 'label' => 'Start date', 'type_label' => 'start_date_type'],
    'primary_completion_date' => ['type' => 'date', 'label' => 'Primary Completion', 'type_label' => 'primary_completion_date_type'],
    'completion_date' => ['type' => 'date', 'label' => 'Completion Date', 'type_label' => 'completion_date_type'],
    'first_posted' => ['type' => 'date', 'label' => 'Study First Posted', 'type_label' => 'first_posted_type'],
    'results_first_posted' => ['type' => 'date', 'label' => 'Results First Posted', 'type_label' => 'results_first_posted_type'],
    'last_update_posted' => ['type' => 'date', 'label' => 'Last Updated', 'type_label' => null],
];
?>

@if($clinicalTrial->focus->count() > 0)
    <div class="d-flex flex-wrap align-items-center">
        @foreach ($clinicalTrial->focus as $item)
            <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
        @endforeach
    </div>
@endif

@if($clinicalTrial->brief_summary != '' AND $clinicalTrial->brief_summary != 'Not applicable')
    <div class="mt-4 mb-5">
        <h3 class="text-primary h4 border-bottom border-2 border-secondary">Brief Summary</h3>
        <div>{!! $clinicalTrial->brief_summary !!}</div>
    </div>
@endif

<div class="row mb-5">
    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <h3 class="h4 text-primary border-bottom border-2 border-secondary mb-2">
            Intervention / Treatment
            <a href="#arm_groups" class="text-decoration-none text-accent" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Participant Groups">
                <i class="fa-sharp fa-solid fa-circle-info fa-xs"></i>
            </a>
        </h3>
        @if($clinicalTrial->intervention_model_description)
            <div class="mb-2 text-secondary">{{ $clinicalTrial->intervention_model_description }}</div>
        @endif
        <ul class="mb-0 list-group list-group-flush">
            @foreach ($clinicalTrial->interventions as $item)
                <li class="list-group-item px-0">
                    <div>
                        <strong class="text-uppercase me-2 text-body-emphasis">{{ $item->value }}</strong>
                        @if($item->pivot->type)
                            <span class="text-secondary small">({{ $item->pivot->type }})</span>
                        @endif
                    </div>
                    @if($item->pivot->description AND ($item->pivot->description !== $item->value))
                        <div>{{ $item->pivot->description }}</div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-12 col-lg-6 ps-xl-5">
        @if($clinicalTrial->conditions->count() > 0)
            <div class="mb-4">
                <h3 class="h4 text-primary border-bottom border-2 border-secondary mb-2">Condition or Disease</h3>
                <ul class="mb-0 list-group list-group-flush">
                    @foreach ($clinicalTrial->conditions as $item)
                        <li class="list-group-item px-0">{{ $item->value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <h3 class="h4 text-primary border-bottom border-2 border-secondary mb-2">Phase</h3>
            @php
                $phases = explode('|', $clinicalTrial->phases)
            @endphp
            @foreach ($phases as $phase)
                <ul class="mb-0 list-group list-group-flush">
                    <li class="list-group-item px-0">{{ $phase }}</li>
                </ul>
            @endforeach
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-6 mb-4 mb-lg-0">
        <h2 class="text-primary h4 border-bottom border-2 border-secondary">Study Design</h2>
        <div class="table-responsive">
            <table class="table table-sm table-borderless me-4 w-auto">
                @foreach($primary_fields as $key => $field)
                    @if($clinicalTrial->$key != '')
                        <tr>
                            <th class="py-2 text-end text-uppercase @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="py-2 @if($loop->first) border-top-0 @endif">
                                @if($field['type'] == 'text')
                                    {{ $clinicalTrial->$key }}
                                @endif
                                @if($field['type'] == 'date')
                                    {{ Carbon\Carbon::parse($clinicalTrial->$key)->format('M d, Y') }}
                                @endif
                                @if($field['type'] == 'url')
                                    <a href="{{ $clinicalTrial->$key }}" target="_blank" rel="noopener noreferrer">
                                        {{ $clinicalTrial->$key }}
                                    </a>
                                @endif
                                @if($field['type_label'])
                                    <span class="text-muted">({{ $clinicalTrial->{$field['type_label']} }})</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2">
                        <h4 class="h5 border-bottom mt-3">Masking</h4>
                        @if($clinicalTrial->masking_description)
                            <p>{{ $clinicalTrial->masking_description }}</p>
                        @endif

                        @if($clinicalTrial->who_masked)
                            @if($clinicalTrial->masking) <strong>{{ $clinicalTrial->masking }}:</strong> @endif
                            <ul>
                                @foreach($clinicalTrial->who_masked as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-12 col-xl-6 ps-xl-5">
        <h3 class="text-primary h4 border-bottom border-2 border-secondary">Clinical Trial Dates</h3>
        <table class="table table-sm table-borderless w-auto">
            @foreach($dates as $key => $field)
                @if($clinicalTrial->$key != '')
                    <tr>
                        <th class="text-end text-uppercase @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                        <td class="@if($loop->first) border-top-0 @endif">
                            {{ Carbon\Carbon::parse($clinicalTrial->$key)->format('M d, Y') }}
                        </td>
                        <td>
                            @if($field['type_label'])
                                <span class="text-muted text-small">{{ $clinicalTrial->{$field['type_label']} }}</span>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>

<div class="my-4">
    <h2 class="text-primary h4 border-bottom border-2 border-secondary">Sponsors / Collaborators</h2>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="lead my-2">
                <strong class="text-uppercase me-1">Lead Sponsor:</strong>
                @if($clinicalTrial->leadSponsor)
                    <span>{{ $clinicalTrial->leadSponsor->name }}</span>
                @else
                    <span>N/A</span>
                @endif
            </div>
            @if($clinicalTrial->lead_sponsor_notes)
                <div class="text-muted my-2">
                    {{ $clinicalTrial->lead_sponsor_notes }}
                </div>
            @endif
            <div class="lead my-2">
                <strong class="text-uppercase me-1">Responsible Party:</strong>
                @if($clinicalTrial->responsibleParty)
                    {{ $clinicalTrial->responsibleParty->name }}
                @else
                    <span>N/A</span>
                @endif
            </div>
            @if($clinicalTrial->responsible_party_notes)
                <div class="text-muted my-2">
                    {{ $clinicalTrial->responsible_party_notes }}
                </div>
            @endif
        </div>
    </div>
</div>

@if($clinicalTrial->locations->count() > 0)
    <div class="mb-5">
        <h3 class="h4 text-primary border-bottom border-2 border-secondary">Location</h3>
        <div class="lead">
            @foreach ($clinicalTrial->locations as $location)
                <div class="my-2">
                    <a href="{{ route('discover.locations.show', $location->slug) }}" class="text-body text-decoration-none">{{ $location->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($clinicalTrial->detailed_description != '' AND $clinicalTrial->detailed_description != 'Not applicable')
    <div class="my-4">
        <h3 class="h4 collapse-heading border-bottom border-2 border-secondary">
            <button data-bs-toggle="collapse" href="#detailedDescription" aria-expanded="true" aria-controls="detailedDescription" class="btn px-0">
                <span class="text-primary d-block mt-1">Detailed Description</span>
                <i class="fa-sharp fa-solid fa-angle-down"></i>
            </button>
        </h3>
        <div class="collapse multi-collapse show" id="detailedDescription">
            <div class="pt-3">
                {!! $clinicalTrial->detailed_description !!}
            </div>
        </div>
    </div>
@endif

@if($clinicalTrial->arm_groups)
    <div id="arm_groups" class="mb-5 pt-5 max-width-780">
        <h3 class="text-primary h4 border-bottom border-2 border-secondary">Participant Groups</h3>
        <ul class="list-group list-group-flush rounded-0 mb-0">
            @foreach($clinicalTrial->arm_groups as $key => $armGroup)
                <li class="list-group-item px-0">
                    <button
                        class="btn btn-toggle btn-toggle-tall border-0"
                        data-bs-toggle="collapse" data-bs-target="#arm-group-{{ $key }}" aria-expanded="false">
                        @isset($armGroup['type'])
                            <strong class="text-uppercase">{{ $armGroup['type'] }}</strong>
                        @endisset
                        <span class="d-block small text-muted fw-normal">{{ $armGroup['label'] }}</span>
                    </button>
                    <div class="collapse" id="arm-group-{{ $key }}">
                        <p class="px-4 mb-0 small text-secondary">{{ $armGroup['description'] ?? 'No description provided' }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="my-5 max-width-780">
    <h3 class="text-primary h4 border-bottom border-2 border-secondary">Eligibility Criteria</h3>
    <table class="table table-sm table-borderless w-auto">
        @if($clinicalTrial->gender)
            <tr>
                <th class="text-end text-uppercase">Sex:</th>
                <td>{{ $clinicalTrial->gender }}</td>
            </tr>
        @endif
        @if($clinicalTrial->min_age)
            <tr>
                <th class="text-end text-uppercase border-top-0">Minimum Age:</th>
                <td>{{ $clinicalTrial->min_age }}</td>
            </tr>
        @endif
        @if($clinicalTrial->max_age)
            <tr>
                <th class="text-end text-uppercase">Maximum Age:</th>
                <td>{{ $clinicalTrial->max_age }}</td>
            </tr>
        @endif
        @if($clinicalTrial->age_groups)
            <tr>
                <th class="text-end text-uppercase">Age Groups:</th>
                <td>
                    @foreach($clinicalTrial->age_groups as $group)
                        <span>{{ $group }}</span>
                        @if(!$loop->last) <span class="text-muted">/</span> @endif
                    @endforeach
                </td>
            </tr>
        @endif
        @if($clinicalTrial->healthy_volunteers !== NULL)
            <tr>
                <th class="text-end text-uppercase">Healthy Volunteers:</th>
                <td>{{ ($clinicalTrial->healthy_volunteers === 1) ? 'Yes' : 'No' }}</td>
            </tr>
        @endif
    </table>
    @if($clinicalTrial->eligibility_criteria)
        <div class="mt-2">
            <h3 class="h5 collapse-heading border-bottom">
                <button data-bs-toggle="collapse" href="#detailedEligibilityCriteria" aria-expanded="false" aria-controls="detailedEligibilityCriteria" class="btn px-0">
                    <span class="d-block mt-1">Detailed Eligibility Criteria</span>
                    <i class="fa-sharp fa-solid fa-angle-down"></i>
                </button>
            </h3>
            <div class="collapse" id="detailedEligibilityCriteria">
                <div class="pt-2">
                    {!! $clinicalTrial->eligibility_criteria !!}
                </div>
            </div>
        </div>
    @endif
</div>

@if($clinicalTrial->primary_outcomes OR $clinicalTrial->secondary_outcomes OR $clinicalTrial->other_outcomes)
    <div class="my-5 max-width-780">
        <h3 class="h4 collapse-heading border-bottom border-2 border-secondary">
            <button data-bs-toggle="collapse" href="#outcomeMeasures" aria-expanded="true" aria-controls="outcomeMeasures" class="btn px-0">
                <span class="text-primary d-block mt-1">Outcome Measures</span>
                <i class="fa-sharp fa-solid fa-angle-down"></i>
            </button>
        </h3>
        <div class="collapse show" id="outcomeMeasures">
            <div>
                @if($clinicalTrial->primary_outcomes)
                    <h5 class="mt-3">Primary Outcomes</h5>
                    <ul class="list-group list-group-flush rounded-0">
                        @foreach($clinicalTrial->primary_outcomes as $key => $item)
                            <x-entities.clinical-trials.outcome-measure uniqueId="primary-outcome-{{ $key }}" :item="$item" />
                        @endforeach
                    </ul>
                @endif
                @if($clinicalTrial->secondary_outcomes)
                    <h5 class="mt-3">Secondary Outcomes</h5>
                    <ul class="list-group list-group-flush rounded-0">
                        @foreach($clinicalTrial->secondary_outcomes as $key => $item)
                            <x-entities.clinical-trials.outcome-measure uniqueId="secondary-outcome-{{ $key }}" :item="$item" />
                        @endforeach
                    </ul>
                @endif
                @if($clinicalTrial->other_outcomes)
                    <h5 class="mt-3">Other Outcomes</h5>
                    <ul class="list-group list-group-flush rounded-0">
                        @foreach($clinicalTrial->other_outcomes as $key => $item)
                            <x-entities.clinical-trials.outcome-measure uniqueId="other-outcome-{{ $key }}" :item="$item" />
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endif

<div class="my-5 max-width-780">
    <h4 class="text-primary border-bottom border-2 border-secondary">More Details</h4>
    <div class="table-responsive">
        <table class="table table-borderless table-sm w-auto">
            @foreach($secondary_fields as $key => $field)
                @if($clinicalTrial->$key != '')
                    <tr>
                        <th class="text-end text-uppercase text-nowrap">{{ $field['label'] }}:</th>
                        <td>
                            @if($field['type'] == 'text')
                                {{ $clinicalTrial->$key }}
                            @endif
                            @if($field['type'] == 'url')
                                <a href="{{ $clinicalTrial->$key }}" target="_blank" rel="noopener noreferrer">
                                    {{ $clinicalTrial->$key }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>
