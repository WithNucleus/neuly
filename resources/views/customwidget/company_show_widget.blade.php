<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4 col-xl-8 p-0">
	<div class="row">
		<div class="col-12 col-md-8 col-xl-6 d-flex">
			<div class="card card-body flex-fill">
				<div>
					@if($widget['company']->logo != '')
						<img src="/storage/{{ $widget['company']->logo }}" alt="{{ $widget['company']->name }}" class="company-logo pull-right">
					@endif
					<h2 class="h3">{{ $widget['company']->name }}</h2>

					@if ($widget['company']->website != '')
						<p class="mb-2"><a href="{{ $widget['company']->website }}" target="_blank" rel="noopener noreferrer">
							{{ $widget['company']->website }} <i class="las la-external-link-alt"></i>
						</a></p>
					@endif
			
					<p class="mb-0">
						<strong>Focus: </strong>
						@forelse ($widget['company']['focus'] as $item)
							<a href="/admin/focus/{{ $item->id }}/show">{{ $item->name }}</a>@if (!$loop->last) / @endif
						@empty
							-
						@endforelse
					</p>
				</div>
			</div>
		</div>

		@if ($widget['company']['locations']->count() > 0)
			<div class="col-12 col-md-8 col-xl-6 d-flex">
				<div class="card card-body flex-fill">
					<h5 class="mb-1">Locations</h5>
			
					<div class="list-group list-group-flush">
						@foreach ($widget['company']['locations'] as $location)
							<div class="list-group-item">
								<a href="/admin/location/{{ $location->id }}/show" class="d-block">{{ $location->name }}</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif

		<div class="col-12 col-md-8 col-xl-6 d-flex">
			<div class="card card-body flex-fill">
				<div class="row mb-2">
					<div class="col"><h5 class="mb-1">People</h5></div>
					<div class="col text-right">
						<a href="/admin/companyperson/{{ $widget['company']->id }}" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>
					</div>
				</div>
		
				<div class="list-group list-group-flush">
					@forelse ($widget['company']['people'] as $person)
						<div class="list-group-item d-flex justify-content-between">
							<a href="/admin/person/{{ $person->id }}/show">
								{{ $person->name }} ({{ $person->getOriginal('pivot_position') }})
							</a> 
							<a class="small" onclick="return confirm_action()" href="{{ route('companyperson.remove', ['company_id' => $widget['company']->id, 'person_id' => $person->id]) }}">
								<i class="la la-trash"></i> Remove
							</a>
						</div>
					@empty
						-
					@endforelse
				</div>
			</div>
		</div>

		@if ($widget['company']['investors']->count() > 0)
			<div class="col-12 col-md-8 col-xl-6 d-flex">
				<div class="card card-body flex-fill">
					<h5 class="mb-1">Investors</h5>
			
					<div class="list-group list-group-flush">
						@foreach ($widget['company']['investors'] as $investor)
							<div class="list-group-item d-flex justify-content-between">
								<a href="/admin/investor/{{ $investor->id }}/show" class="d-block">{{ $investor->name }}</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif

		@if ($widget['company']['clinicaltrials']->count() > 0)
	        <div class="col-12 col-md-8 col-xl-6 d-flex">
	            <div class="card card-body flex-fill">
	                <h5 class="mb-0">Clinical Trials</h5>

	                <div class="list-group list-group-flush">
	                    @foreach ($widget['company']['clinicaltrials'] as $clinicaltrial)
	                        <div class="list-group-item d-flex justify-content-between">
	                            <a href="/admin/clinicaltrial/{{ $clinicaltrial->id }}/show">
	                                {{ $clinicaltrial->title }}
	                            </a>
	                        </div>
	                    @endforeach
	                </div>
	            </div>
	        </div>
        @endif

		@if ($widget['company']['research']->count() > 0)
	        <div class="col-12 col-md-8 col-xl-6 d-flex">
	            <div class="card card-body flex-fill">
	                <h5 class="mb-0">Research</h5>

	                <div class="list-group list-group-flush">
	                    @foreach ($widget['company']['research'] as $item)
	                        <div class="list-group-item d-flex justify-content-between">
	                            <a href="/admin/research/{{ $item->id }}/show">
	                                {{ $item->name }}
	                            </a>
	                        </div>
	                    @endforeach
	                </div>
	            </div>
	        </div>
        @endif

        @if ($widget['company']['events']->count() > 0)
	        <div class="col-12 col-md-8 col-xl-6 d-flex">
	            <div class="card card-body flex-fill">
	                <h5 class="mb-0">Events</h5>

	                <div class="list-group list-group-flush">
	                    @foreach ($widget['company']['events'] as $event)
	                        <div class="list-group-item d-flex justify-content-between">
	                            <a href="/admin/event/{{ $event->id }}/show">
	                                {{ $event->name }}
	                            </a>
	                        </div>
	                    @endforeach
	                </div>
	            </div>
	        </div>
        @endif

        @if ($widget['company']['jobs']->count() > 0)
	        <div class="col-12 col-md-8 col-xl-6 d-flex">
	            <div class="card card-body flex-fill">
	                <h5 class="mb-0">Jobs</h5>

	                <div class="list-group list-group-flush">
	                    @foreach ($widget['company']['jobs'] as $job)
	                        <div class="list-group-item d-flex justify-content-between">
	                            <a href="/admin/job/{{ $job->id }}/show">
	                                {{ $job->job_title }}
	                            </a>
	                        </div>
	                    @endforeach
	                </div>
	            </div>
	        </div>
        @endif
    </div>
</div>

<style>
	.company-logo {
		height:  auto;
		width:  75px;
		float:  right;
	}
	.list-group-flush .list-group-item {
		padding: .25rem 0;
	}
	.list-group-flush .list-group-item:first-child {
        border-top-width: 0;
    }
</style>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>