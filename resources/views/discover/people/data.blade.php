<div class="row">
	<div class="col-12 col-md-8 col-lg-7">

		@auth
			@if($person->website != '')
				<p class="mb-2">
					<strong>Website:</strong><br>
					
					<a href="{{ $person->website }}" target="_blank" rel="noopener noreferrer">
						{{ $person->website }} <i class="fad fa-external-link fa-xs"></i>
					</a>
				</p>
			@endif

			@if($person->google_scholar != '')
				<p class="mb-2">			
					<a href="{{ $person->google_scholar }}" target="_blank" rel="noopener noreferrer">
						Google Scholar <i class="fad fa-external-link fa-xs"></i>
					</a>
				</p>
			@endif

			@if($person->companies->count() > 0)
				<p class="mb-2">
					<strong>Organizations:</strong><br>
					@foreach ($person->companies as $company)
					    <a href="{{ route('discover.organizations.show', $company->slug) }}">{{ $company->name }} ({{ $company->pivot->position }})</a> @if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

			@if($person->investors->count() > 0)
			<p class="mb-2">
				<strong>Investors:</strong><br>
			
				@foreach ($person->investors as $investor)
				    <a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }} <span class="text-dark">({{ $investor->pivot->role }})</span></a>
				    
				    @if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif

			@if($person->locations->count() > 0)
				<p class="mb-2">
					<strong>Location:</strong><br>
					@foreach ($person->locations as $location)
					    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>@if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

			@if($person->research->count() > 0)
				<p class="mb-0 mt-4 h5">Research:</p>
				<ul class="list-group list-group-flush">
					@foreach ($person->research as $item)
					    <li class="list-group-item px-0 py-1">
					    	<a class="d-block" href="{{ route('discover.research.show', $item->slug) }}">{{ $item->name }}</a>
					    </li>
					@endforeach
				</ul>
			@endif

			@if($person->clinicalTrials->count() > 0)
				<p class="mb-0 mt-4 h5">Clinical Trials:</p>
				<ul class="list-group list-group-flush">
					@foreach ($person->clinicalTrials as $clinicalTrial)
					    <li class="list-group-item px-0 py-1">
					    	<a class="d-block" href="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}">{{ $clinicalTrial->title }}</a>
					    </li>
					@endforeach
				</ul>
			@endif

			@if($person->bio != '')
				<p class="mb-0">
					<strong>Bio:</strong>
				</p>
				{!! $person->bio !!}
			@endif

		@else

			@include('discover.includes.register-gate', ['details' => $person->name . '\'s details'])
			
		@endauth

	</div>
	<div class="col-12 col-md-4 col-lg-5 text-center">
		@auth
			@if($person->photo != '')
				<div class="person-photo-large shadow-sm" style="background-image: url('/storage/{{ $person->photo }}');">
					<span class="sr-only">{{ $person->name }}</span>
				</div>
			@else
				<img src="{{ asset('images/person-blank.png') }}" class="person-photo-large shadow-sm" alt="{{ $person->name }}">
			@endif

			<p class="text-center">
				@if ($person->linkedin)
		            	<a href="https://www.linkedin.com/in/{{ $person->linkedin }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-linkedin fa-2x"></i></a>
		        @endif
		        @if ($person->twitter)
		            	<a href="https://www.twitter.com/{{ $person->twitter }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-twitter fa-2x"></i></a>
		        @endif
		        @if ($person->facebook)
		            	<a href="https://www.facebook.com/{{ $person->facebook }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-facebook fa-2x"></i></a>
		        @endif
		    </p>
		@endauth
	</div>
</div>