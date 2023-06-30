<?php
$primary_fields = [
    'study_type' => ['type' => 'text', 'label' => 'Study type'],
    'status' => ['type' => 'text', 'label' => 'Status'],
    'study_results' => ['type' => 'text', 'label' => 'Study results'],
    // 'phases' => ['type' => 'text', 'label' => 'Phases'],
    'gender' => ['type' => 'text', 'label' => 'Gender'],
    'age' => ['type' => 'text', 'label' => 'Age'],
    'enrollment' => ['type' => 'text', 'label' => 'Enrollment'],
    'funded_bys' => ['type' => 'text', 'label' => 'Funded by'],
];

$secondary_fields = [
    'nct_number' => ['type' => 'text', 'label' => 'NCT Number'],
    'acronym' => ['type' => 'text', 'label' => 'Acronym'],
    'other_ids' => ['type' => 'text', 'label' => 'Other IDs'],
    'study_url' => ['type' => 'url', 'label' => 'Study URL']
];

$dates = [
    'start_date' => ['type' => 'date', 'label' => 'Start date'],
    'primary_completion_date' => ['type' => 'date', 'label' => 'Primary completion date'],
    'completion_date' => ['type' => 'date', 'label' => 'Completion date'],
    'first_posted' => ['type' => 'date', 'label' => 'First posted'],
    'results_first_posted' => ['type' => 'date', 'label' => 'Results first posted'],
    'last_update_posted' => ['type' => 'date', 'label' => 'Last update posted'],
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
    <div class="my-4">
        <h3 class="h4 font-normal border-bottom">Brief Summary</h3>
        <div class="max-width-780">{!! $clinicalTrial->brief_summary !!}</div>
    </div>
@endif

<div class="table-responsive my-5">
    <table class="table table-bordered border-secondary-subtle">
        <tr>
            <th class="bg-secondary-subtle">
                <span class="h5 m-0 d-block" style="padding-top: .25rem">Condition or Disease</span>
            </th>
            <th class="bg-secondary-subtle">
                <span class="h5 m-0 d-block" style="padding-top: .25rem">Intervention / Treatment</span>
            </th>
            <th class="bg-secondary-subtle">
                <span class="h5 m-0 d-block" style="padding-top: .25rem">Phase</span>
            </th>
        </tr>
        <tr>
            <td>
                @if($clinicalTrial->conditions->count() > 0)
                    <ul class="mb-0">
                        @foreach ($clinicalTrial->conditions as $item)
                            <li>{{ $item->value }}</li>
                        @endforeach
                    </ul>
                @endif
            </td>
            <td>
                @if($clinicalTrial->interventions->count() > 0)
                    <ul class="mb-0">
                        @foreach ($clinicalTrial->interventions as $item)
                            <li>{{ $item->value }}</li>
                        @endforeach
                    </ul>
                @endif
            </td>
            <td>
                @php
                    $phases = explode('|', $clinicalTrial->phases)
                @endphp
                @foreach ($phases as $phase)
                    <ul class="mb-0">
                        <li>{{ $phase }}</li>
                    </ul>
                @endforeach
            </td>
        </tr>
    </table>
</div>

<div class="my-4">
    @if($clinicalTrial->people->count() > 0 OR $clinicalTrial->companies->count() > 0)
        <div class="row">
            <div class="col-12">
                <h2 class="h3">Sponsors / Collaborators</h2>
            </div>

            @if($clinicalTrial->companies->count() > 0)
                @foreach ($clinicalTrial->companies as $company)
                    <x-entities.related.company-card :company="$company" />
                @endforeach
            @endif

            @if($clinicalTrial->companies->count() > 0)
                @foreach ($clinicalTrial->people as $person)
                    <x-entities.related.person-card :person="$person" />
                @endforeach
            @endif
        </div>
    @endif
</div>

@if($clinicalTrial->locations->count() > 0)
    <h3 class="lead font-normal font-weight-bold mb-1">Location:</h3>
    <p class="mb-0">
        @foreach ($clinicalTrial->locations as $location)
            <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>

            @if (!$loop->last)<br>@endif
        @endforeach
    </p>
@endif

@if($clinicalTrial->detailed_description != '' AND $clinicalTrial->detailed_description != 'Not applicable')
    <div class="my-4">
        <h3 class="h4 collapse-heading border-bottom">
            <button data-bs-toggle="collapse" href="#detailedDescription" aria-expanded="true" aria-controls="detailedDescription" class="btn px-0">
                <span class="d-block mt-1">Detailed Description</span>
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

<div class="row">
    <div class="col-12 col-xl-6">
        <h2 class="h4 border-bottom">Study Design</h2>
        <div class="table-responsive">
            <table class="table table-sm table-borderless mr-4">
                @foreach($primary_fields as $key => $field)
                    @if($clinicalTrial->$key != '')
                        <tr>
                            <th class="pl-4 py-2 text-right @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="pr-4 py-2 @if($loop->first) border-top-0 @endif">
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
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if($clinicalTrial->studyDesigns->count() > 0)
                    @foreach ($clinicalTrial->studyDesigns as $item)
                        @php
                            $itemArray = explode(':', $item->value);
                        @endphp
                        <tr>
                            @if (array_key_exists(0, $itemArray) AND array_key_exists(1, $itemArray))
                                <th class="text-no-wrap text-right">{{ $itemArray[0] }}:</th>
                                <td class="">{{ $itemArray[1] }}</td>
                            @else
                                <td colspan="2">{{ $item->value }}</td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    <div class="col-12 col-xl-5 ml-xl-3">
        <h3 class="h4 border-bottom">Clinical Trial Dates</h3>
        <table class="table table-sm table-borderless auto-width">
            @foreach($dates as $key => $field)
                @if($clinicalTrial->$key != '')
                    <tr>
                        <th class="text-right @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                        <td class="@if($loop->first) border-top-0 @endif">
                            {{ Carbon\Carbon::parse($clinicalTrial->$key)->format('M d, Y') }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>


@if($clinicalTrial->outcomeMeasures->count() > 0)
    <div class="my-5 max-width-780">
        <h3 class="h4 font-normal border-bottom">Outcome Measures</h3>
        <ul>
            @foreach ($clinicalTrial->outcomeMeasures as $item)
                <li>{{ $item->value }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="my-5 max-width-780">
    <h4 class="h5 border-bottom font-normal">More Details</h4>
    <div class="table-responsive">
        <table class="table table-borderless table-sm auto-width">
            @foreach($secondary_fields as $key => $field)
                @if($clinicalTrial->$key != '')
                    <tr>
                        <th class="text-right text-no-wrap">{{ $field['label'] }}:</th>
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
