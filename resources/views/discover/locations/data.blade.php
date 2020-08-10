<div class="row">
	<div class="col-12">

		@if($location->companies->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#organizations" aria-expanded="true" aria-controls="organizations"><i class="fa fa-plus text-info"></i> Organizations ({{ $location->companies->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="organizations">
					<div class="d-flex flex-wrap">
						@foreach ($location->companies as $company)
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
				</div>
			</div>
		@endif

		@if($location->people->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#people" aria-expanded="true" aria-controls="people"><i class="fa fa-plus text-info"></i> People ({{ $location->people->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="people">
					<ul class="list-group list-group-flush">
						@foreach ($location->people as $person)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		@if($location->investors->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#investors" aria-expanded="true" aria-controls="investors"><i class="fa fa-plus text-info"></i> Investors ({{ $location->investors->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="investors">
					<ul class="list-group list-group-flush">
						@foreach ($location->investors as $investor)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		@if($location->jobs->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#jobs" aria-expanded="true" aria-controls="jobs"><i class="fa fa-plus text-info"></i> Jobs ({{ $location->jobs->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="jobs">
					<ul class="list-group list-group-flush">
						@foreach ($location->jobs as $job)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.jobs.show', $job->slug) }}">{{ $job->job_title }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		@if($location->events->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#events" aria-expanded="true" aria-controls="events"><i class="fa fa-plus text-info"></i> Events ({{ $location->events->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="events">
					<ul class="list-group list-group-flush">
						@foreach ($location->events as $event)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		@if($location->clinicaltrials->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#clinicaltrials" aria-expanded="true" aria-controls="clinicaltrials"><i class="fa fa-plus text-info"></i> Clinical Trials ({{ $location->clinicaltrials->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="clinicaltrials">
					<ul class="list-group list-group-flush">
						@foreach ($location->clinicaltrials as $clinicaltrial)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">{{ $clinicaltrial->title }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

	</div>
</div>

<script>
	$(document).ready(function(){

		$(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){

        	console.log("show");

        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");

        }).on('hide.bs.collapse', function(){

        	console.log("collapse");

        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");

        });
    });
</script>
