<div class="row">
	@auth
			<div class="col-12 col-md-8 col-lg-7">

			<?php
			$fields = array(
				'nct_number' => ['type' => 'text', 'label' => 'NCT Number'],
				//'title' => ['type' => 'text', 'label' => 'Title'],
				'acronym' => ['type' => 'text', 'label' => 'Acronym'],
				'status' => ['type' => 'text', 'label' => 'Status'],
				'study_results' => ['type' => 'text', 'label' => 'Study results'],
				'gender' => ['type' => 'text', 'label' => 'Gender'],
				'age' => ['type' => 'text', 'label' => 'Age'],
				'phases' => ['type' => 'text', 'label' => 'Phases'],
				'enrollment' => ['type' => 'text', 'label' => 'Enrollment'],
				'funded_bys' => ['type' => 'text', 'label' => 'Funded bys'],
				'study_type' => ['type' => 'text', 'label' => 'Study type'],
				'other_ids' => ['type' => 'text', 'label' => 'Other IDs'],
				'start_date' => ['type' => 'date', 'label' => 'Start date'],
				'primary_completion_date' => ['type' => 'date', 'label' => 'Primary completion date'],
				'completion_date' => ['type' => 'date', 'label' => 'Completion date'],
				'first_posted' => ['type' => 'date', 'label' => 'First posted'],
				'results_first_posted' => ['type' => 'date', 'label' => 'Results first posted'],
				'last_update_posted' => ['type' => 'date', 'label' => 'Last update posted'],
				'study_url' => ['type' => 'url', 'label' => 'Study URL'],
			);
			?>

			@foreach($fields as $key => $field)
				@if($clinicaltrial->$key != '')
					<p class="mb-2">
						<strong>{{ $field['label'] }}:</strong><br>
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
					</p>
				@endif
			@endforeach

            @if($clinicaltrial->conditions->count() > 0)
                <p><strong>Conditions:</strong></p>
                <ul class="mb-2">
                    @foreach ($clinicaltrial->conditions as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->interventions->count() > 0)
                <p><strong>Interventions:</strong></p>
                <ul class="mb-2">
                    @foreach ($clinicaltrial->interventions as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->outcomeMeasures->count() > 0)
                <p><strong>Outcome Measures:</strong></p>
                <ul class="mb-2">
                    @foreach ($clinicaltrial->outcomeMeasures as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

            @if($clinicaltrial->studyDesigns->count() > 0)
                <p><strong>Study Designs:</strong></p>
                <ul class="mb-2">
                    @foreach ($clinicaltrial->studyDesigns as $item)
                        <li>{{ $item->value }}</li>
                    @endforeach
                </ul>
            @endif

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

		</div>


	@else

		<div class="col-12 mx-auto">
			@include('discover.includes.register-gate', ['details' => ' the details of this Clinical Trial'])
		</div>

	@endauth
</div>
