<div class="row">
	<div class="col-12 col-md-6">
		<p class="lead mb-2">
			<span class="sr-only">Date:</span> {{ Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
			@if($event->end_date != '')
				- {{ Carbon\Carbon::parse($event->end_date)->format('M d, Y') }}
			@endif
		</p>

		@if($event->eventTypes()->count() > 0)
			<p class="mb-2">
				<strong>Event Type:</strong><br>

				@foreach ($event->eventTypes as $type)
					{{ $type->name }}@if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif

		@if($event->event_url != '')
			<p class="mb-2">
				<strong>Event URL:</strong><br>
				<a href="{{ $event->event_url }}" target="_blank" rel="noopener noreferrer">{{ $event->event_url }} <small><i class="fad fa-external-link"></i></small></a>
			</p>
		@endif

		@if($event->registration_url != '')
			<p class="mb-2">
				<strong>Registration URL:</strong><br>
				<a href="{{ $event->registration_url }}" target="_blank" rel="noopener noreferrer">{{ $event->registration_url }} <small><i class="fad fa-external-link"></i></small></a>
			</p>
		@endif

		@if($event->locations->count() > 0)
			<p class="mb-2">
				<strong>Locations:</strong><br>

				@foreach ($event->locations as $location)
				    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>@if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif

		@if($event->description != '')
			<p class="mb-2">
				<strong>Description:</strong><br>
				{!! $event->description !!}
			</p>
		@endif
	</div>

	<div class="col-12 col-md-6">

		@if($event->image != '')
			 <div class="text-center">
			 	<img src="/storage/{{ $event->image }}" alt="{{ $event->name }}" class="event-show-logo mx-auto mb-4">
			 </div>
		@endif

		@if($event->focus->count() > 0)
			<p class="mb-2">
				<strong>Focus:</strong><br>

				@foreach ($event->focus as $item)
				    <a href="{{ route('discover.focus.show', $item->slug )}} ">{{ $item->name }}</a> @if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif

		@if($event->people->count() > 0)
			<p class="mb-2">
				<strong>People:</strong><br>

				@foreach ($event->people as $person)
				    <a href="{{ route('discover.people.show', $person->slug )}} ">{{ $person->name }}</a> @if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif
	</div>

</div>

@if($event->companies->count() > 0)
	<div class="row mt-3">
		<div class="col-12">
			<h2>Exhibitors:</h2>
		</div>
	</div>
	<div class="row mb-5">
		@foreach ($event->companies as $company)
			<div class="card col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card-body border text-center d-flex justify-content-center align-items-center">
                    @if($company->logo != '')
                        <a href="{{ route('discover.organizations.show', ['slug' => $company->slug]) }}" data-toggle="tooltip" data-placement="top" title="{{$company->name}}">
                            <img src="/storage/{{ $company->logo }}" alt="{{ $company->name }}" class="company-logo mx-auto" alt="{{$company->name}}">
                        </a>
                    @else
                        <a href="{{ route('discover.organizations.show', ['slug' => $company->slug]) }}">{{$company->name}}</a>
                    @endif
                </div>
            </div>
		@endforeach	
	</div>
@endif