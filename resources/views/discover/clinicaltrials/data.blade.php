<div class="row">
	@auth
			<div class="col-12 col-md-8 col-lg-7">

			<?php
			$primary_fields = array(
                'study_type' => ['type' => 'text', 'label' => 'Study type'],
				'status' => ['type' => 'text', 'label' => 'Status'],
				'study_results' => ['type' => 'text', 'label' => 'Study results'],
                'phases' => ['type' => 'text', 'label' => 'Phases'],
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

            <table class="table table-sm auto-width">
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
            </table>

            @if($clinicaltrial->studyDesigns->count() > 0)
                <h2 class="h4 mb-1 font-normal">Study Designs</h2>
                <ul class="mb-4">
                    @foreach ($clinicaltrial->studyDesigns as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->conditions->count() > 0)
                <h2 class="h4 mb-1 font-normal">Conditions:</h2>
                <ul class="mb-4">
                    @foreach ($clinicaltrial->conditions as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->interventions->count() > 0)
                <h3 class="h4 mb-1 font-normal">Interventions:</h3>
                <ul class="mb-4">
                    @foreach ($clinicaltrial->interventions as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->outcomeMeasures->count() > 0)
                <h3 class="h4 mb-1 font-normal">Outcome Measures:</h3>
                <ul class="mb-4">
                    @foreach ($clinicaltrial->outcomeMeasures as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            <h2 class="h5 mb-1 font-normal">More Details</h2>
            <table class="table table-sm auto-width">
                @foreach($secondary_fields as $key => $field)
                    @if($clinicaltrial->$key != '')
                        <tr>
                            <th class="pl-4 text-right py-2 text-right @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="pr-4 py-2 @if($loop->first) border-top-0 @endif">
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
		<div class="col-12 col-md-4 col-lg-5">

			@if($clinicaltrial->locations->count() > 0)
				<p class="mb-2">
					<strong>Location:</strong><br>

					@foreach ($clinicaltrial->locations as $location)
					    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>

					    @if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

			@if($clinicaltrial->people->count() > 0 OR $clinicaltrial->companies->count() > 0)
				<p class="mb-2">
					<strong>Sponsors/Collaborators:</strong><br>

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

            <h3 class="mt-4 h4 font-normal">Clinical Trial Dates</h3>
            <table class="table table-sm auto-width">
                @foreach($dates as $key => $field)
                    @if($clinicaltrial->$key != '')
                        <tr>
                            <th class="pl-4 text-right py-2 @if($loop->first) border-top-0 @endif">{{ $field['label'] }}:</th>
                            <td class="pr-4 py-2 @if($loop->first) border-top-0 @endif">
                                {{ Carbon\Carbon::parse($clinicaltrial->$key)->format('M d, Y') }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>

		</div>


	@else

		<div class="col-12 mx-auto">
			@include('discover.includes.register-gate', ['details' => ' the details of this Clinical Trial'])
		</div>

	@endauth
</div>
