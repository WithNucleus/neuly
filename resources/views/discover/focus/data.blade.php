<div class="row">
	<div class="col-12">

        @if($focus->jobs->count() > 0)
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white">
                    <button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#jobs" aria-expanded="true" aria-controls="jobs"><i class="fa fa-plus text-info"></i> Jobs ({{ $focus->jobs->count() }})</button>
                </div>
                <div class="border-top border-tertiary card-body collapse show" id="jobs">
                    <ul class="list-group list-group-flush">
                        @foreach ($focus->jobs as $job)
                            <div class="list-group-item">
                                <a href="{{ route('discover.jobs.show', $job->slug) }}">{{ $job->job_title }}</a>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($focus->events->count() > 0)
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white">
                    <button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#events" aria-expanded="true" aria-controls="events"><i class="fa fa-plus text-info"></i> Events ({{ $focus->events->count() }})</button>
                </div>
                <div class="border-top border-tertiary card-body collapse show" id="events">
                    <ul class="list-group list-group-flush">
                        @foreach ($focus->events as $event)
                            <div class="list-group-item">
                                <a href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

		@if($focus->companies->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#organizations" aria-expanded="true" aria-controls="organizations"><i class="fa fa-plus text-info"></i> Organizations ({{ $focus->companies->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="organizations">
					<div class="d-flex flex-wrap">
						@foreach ($focus->companies as $company)
							<div class="card col-12 col-sm-6 col-md-4 col-lg-3 mb-5">
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
				</div>
			</div>
		@endif

		@if($focus->research->count() > 0)
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-white">
					<button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#research" aria-expanded="true" aria-controls="research"><i class="fa fa-plus text-info"></i> Research ({{ $focus->research->count() }})</button>
				</div>
				<div class="border-top border-tertiary card-body collapse show" id="research">
					<ul class="list-group list-group-flush">
						@foreach ($focus->research as $item)
						    <div class="list-group-item">
						    	<a href="{{ route('discover.research.show', $item->slug) }}">{{ $item->name }}</a>
						    </div>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

        @if($focus->clinicaltrials->count() > 0)
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white">
                    <button class="text-dark btn btn-link btn-lg p-0" type="button" data-toggle="collapse" data-target="#clinicaltrials" aria-expanded="true" aria-controls="clinicaltrials"><i class="fa fa-plus text-info"></i> Clinical Trials ({{ $focus->clinicaltrials->count() }})</button>
                </div>
                <div class="border-top border-tertiary card-body collapse show" id="clinicaltrials">
                    <ul class="list-group list-group-flush">
                        @foreach ($focus->clinicaltrials as $clinicaltrial)
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
