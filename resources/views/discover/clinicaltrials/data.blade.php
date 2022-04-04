<?php
$primary_fields = array(
    'study_type' => ['type' => 'text', 'label' => 'Study type'],
    'status' => ['type' => 'text', 'label' => 'Status'],
    'study_results' => ['type' => 'text', 'label' => 'Study results'],
    // 'phases' => ['type' => 'text', 'label' => 'Phases'],
    'gender' => ['type' => 'text', 'label' => 'Gender'],
    'age' => ['type' => 'text', 'label' => 'Age'],
    'enrollment' => ['type' => 'text', 'label' => 'Enrollment'],
    'funded_bys' => ['type' => 'text', 'label' => 'Funded by'],
);

$secondary_fields = array(
    'nct_number' => ['type' => 'text', 'label' => 'NCT Number'],
    'acronym' => ['type' => 'text', 'label' => 'Acronym'],
    'other_ids' => ['type' => 'text', 'label' => 'Other IDs'],
    'study_url' => ['type' => 'url', 'label' => 'Study URL']
);

$dates = array(
    'start_date' => ['type' => 'date', 'label' => 'Start date'],
    'primary_completion_date' => ['type' => 'date', 'label' => 'Primary completion date'],
    'completion_date' => ['type' => 'date', 'label' => 'Completion date'],
    'first_posted' => ['type' => 'date', 'label' => 'First posted'],
    'results_first_posted' => ['type' => 'date', 'label' => 'Results first posted'],
    'last_update_posted' => ['type' => 'date', 'label' => 'Last update posted'],
);
?>

@auth

    <div class="row mb-5">
        <div class="col-12 col-lg-6">
            @if($clinicaltrial->people->count() > 0 OR $clinicaltrial->companies->count() > 0)
                <h2 class="lead font-normal font-weight-bold mb-1">Sponsors/Collaborators:</h2>
                <p class="mb-0">
                    @if($clinicaltrial->companies->count() > 0)
                        @foreach ($clinicaltrial->companies as $company)
                            <a href="{{ route('discover.organizations.show', $company->slug )}} ">{{ $company->name }}</a><br>
                        @endforeach
                    @endif

                    @if($clinicaltrial->companies->count() > 0)
                        @foreach ($clinicaltrial->people as $person)
                            <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>

                            @if (!$loop->last)<br>@endif
                        @endforeach
                    @endif
                </p>
            @endif
        </div>
        <div class="col-12 col-lg-6">
            @if($clinicaltrial->locations->count() > 0)
                <h3 class="lead font-normal font-weight-bold mb-1">Location:</h3>
                <p class="mb-0">
                    @foreach ($clinicaltrial->locations as $location)
                        <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>

                        @if (!$loop->last)<br>@endif
                    @endforeach
                </p>
            @endif
        </div>
    </div>
    <div class="table-responsive mb-5">
        <table class="table table-bordered">
            <tr>
                <th class="bg-light text-no-wrap lead-smaller">Condition or Disease</th>
                <th class="bg-light text-no-wrap lead-smaller">Intervention / Treatment</th>
                <th class="bg-light text-no-wrap lead-smaller">Phase</th>
            </tr>
            <tr>
                <td>
                    @if($clinicaltrial->conditions->count() > 0)
                        <ul class="mb-0">
                            @foreach ($clinicaltrial->conditions as $item)
                                <li>{{ $item->value }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    @if($clinicaltrial->interventions->count() > 0)
                        <ul class="mb-0">
                            @foreach ($clinicaltrial->interventions as $item)
                                <li>{{ $item->value }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    @php
                        $phases = explode('|', $clinicaltrial->phases)
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

    <style>
        .has-arrow-icon.collapsed i {
            transform: scaleY(-1);
        }
    </style>

    @if($clinicaltrial->brief_summary != '' AND $clinicaltrial->brief_summary != 'Not applicable')
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="h4 font-normal border-bottom">Brief Summary</h3>
                {!! $clinicaltrial->brief_summary !!}
            </div>
        </div>
    @endif

    @if($clinicaltrial->detailed_description != '' AND $clinicaltrial->detailed_description != 'Not applicable')
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="h4 font-normal border-bottom has-arrow-icon collapsed" data-toggle="collapse" href="#detailedDescription" role="button" aria-expanded="false" aria-controls="detailedDescription">Detailed Description <small class="float-right"><i class="far fa-angle-up"></i></small></h3>
                <div class="collapse" id="detailedDescription">
                    {!! $clinicaltrial->detailed_description !!}
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-5">
    <div class="col-12 col-xl-6">
        <h2 class="h4 font-normal border-bottom">Study Design</h2>
        <div class="table-responsive">
            <table class="table table-sm table-borderless mr-4">
                @foreach($primary_fields as $key => $field)
                    @if($clinicaltrial->$key != '')
                        <tr>
                            <th class="pl-4 py-2 text-right @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="pr-4 py-2 @if($loop->first) border-top-0 @endif">
                                @if($field['type'] == 'text')
                                    {{ $clinicaltrial->$key }}
                                @endif
                                @if($field['type'] == 'date')
                                    {{ Carbon\Carbon::parse($clinicaltrial->$key)->format('M d, Y') }}
                                @endif
                                @if($field['type'] == 'url')
                                    <a href="{{ $clinicaltrial->$key }}" target="_blank" rel="noopener noreferrer">
                                        {{ $clinicaltrial->$key }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if($clinicaltrial->studyDesigns->count() > 0)
                    @foreach ($clinicaltrial->studyDesigns as $item)
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
            <h3 class="h4 font-normal border-bottom">Clinical Trial Dates</h3>
            <table class="table table-sm table-borderless auto-width">
                @foreach($dates as $key => $field)
                    @if($clinicaltrial->$key != '')
                        <tr>
                            <th class="text-right @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="@if($loop->first) border-top-0 @endif">
                                {{ Carbon\Carbon::parse($clinicaltrial->$key)->format('M d, Y') }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            @if($clinicaltrial->outcomeMeasures->count() > 0)
                <h3 class="h4 font-normal border-bottom">Outcome Measures</h3>
                <ul>
                    @foreach ($clinicaltrial->outcomeMeasures as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <h4 class="h5 border-bottom font-normal">More Details</h4>
            <div class="table-responsive">
                <table class="table table-borderless table-sm auto-width">
                    @foreach($secondary_fields as $key => $field)
                        @if($clinicaltrial->$key != '')
                            <tr>
                                <th class="text-right text-no-wrap">{{ $field['label'] }}:</th>
                                <td>
                                    @if($field['type'] == 'text')
                                        {{ $clinicaltrial->$key }}
                                    @endif
                                    @if($field['type'] == 'url')
                                        <a href="{{ $clinicaltrial->$key }}" target="_blank" rel="noopener noreferrer">
                                            {{ $clinicaltrial->$key }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @else

    <div class="row">
        <div class="col-12 mx-auto">
            @include('discover.includes.register-gate', ['details' => ' the details of this Clinical Trial'])
        </div>
    </div>

@endauth
