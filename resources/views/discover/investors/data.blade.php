@auth
	<div class="row">
		<div class="col-12 col-md-8 col-lg-7">
			@if($investor->type != '')
				<p class="mb-2">
						<i class="fad fa-funnel-dollar text-quaternary"></i> {{ $investor->type }}
					</a>
				</p>
			@endif

			@if($investor->website != '')
				<p class="mb-2">
					<a href="{{ $investor->website }}" target="_blank" rel="noopener noreferrer">
						{{ $investor->website }} <i class="fad fa-external-link fa-xs"></i>
					</a>
				</p>
			@endif

			@if($investor->people->count() > 0)
				<p class="mb-2">
					<strong>People:</strong><br>

					@foreach ($investor->people as $person)
					    <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }} <span class="text-dark">({{ $person->pivot->role }})</span></a>

					    @if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

			@if($investor->locations->count() > 0)
				<p class="mb-2">
					<strong>Location:</strong><br>

					@foreach ($investor->locations as $location)
					    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>

					    @if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

		</div>
		<div class="col-12 col-md-4 col-lg-5">

			@if($investor->logo != '')
				<img src="/storage/{{ $investor->logo }}" alt="{{ $investor->name }}" class="company-logo mb-4">
			@endif
		</div>

	</div>

	@if($investor->companies->count() > 0)
		<div class="row mt-4">
			<div class="col-12">
				<h2 class="h3">Organizations:</h2>
			</div>
			@foreach ($investor->companies as $company)
				<div class="card col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
	                <div class="card-body border border-bottom-0 text-center d-flex justify-content-center align-items-center">
	                    @if($company->logo != '')
	                        <a href="{{ route('discover.organizations.show', ['slug' => $company->slug]) }}" data-toggle="tooltip" data-placement="top" title="{{$company->name}}">
	                            <img src="/storage/{{ $company->logo }}" alt="{{ $company->name }}" class="company-logo mx-auto" alt="{{$company->name}}">
	                        </a>
	                    @else
	                        <a href="{{ route('discover.organizations.show', ['slug' => $company->slug]) }}">{{$company->name}}</a>
	                    @endif
	                </div>
	                <div class="card-footer font-size-small">
	                    <strong>Focus:</strong>
	                    @foreach ($company->focus as $focus)
	                        <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>@if (!$loop->last),@endif
	                    @endforeach
	                </div>
	            </div>
			@endforeach
		</div>
	@endif

	@else

		<div class="row">
			<div class="col-12">
				@include('discover.includes.register-gate', ['details' => $investor->name . ' details'])
			</div>
		</div>

	@endauth


</div>
