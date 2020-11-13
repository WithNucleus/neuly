@auth
	<div class="row">
		<div class="col-12 col-md-6 pt-2 pt-md-5 order-md-1">
			<p class="lead text-center">
				<a href="{{ route('discover.organizations.show', $job->company->slug) }}">
					<img src="{{ $job->company->entityImageUrl }}" alt="{{ $job->company->name }}" class="company-logo"><br>
					{{ $job->company->name }}
				</a>
			</p>

            <p class="text-center">
            	<a href="{{ route('discover.jobs.apply', $job->slug) }}" class="d-inline-block btn btn-lg btn-danger mt-2" style="white-space: nowrap;">Apply Now</a>
            </p>

		</div>
		<div class="col-12 col-md-6 order-md-0">
			<p class="mb-2">
				<strong>Posted Date:</strong><br>
				{{ Carbon\Carbon::parse($job->posted_date)->format('M d, Y') }}
			</p>

			<p class="mb-2">
				<strong>Employment Type:</strong><br>
				{{ $job->employment_type }}
			</p>

            @if($job->salary)
            <p class="mb-2">
                <strong>Salary:</strong><br>
                ${{ number_format($job->salary) }}
            </p>
            @endif

            @if($job->hourly_rate)
                <p class="mb-2">
                    <strong>Hourly rate:</strong><br>
                    ${{ number_format($job->hourly_rate, 2) }}
                </p>
            @endif

			@if($job->locations->count() > 0)
				<p class="mb-2">
					<strong>Location:</strong><br>

					@foreach ($job->locations as $location)
					    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>@if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

			@if($job->focus->count() > 0)
				<p class="mb-2">
					<strong>Focus:</strong><br>

					@foreach ($job->focus as $item)
					    <a href="{{ route('discover.focus.show', $item->slug )}} ">{{ $item->name }}</a> @if (!$loop->last)<br>@endif
					@endforeach
				</p>
			@endif

            <h2 class="mt-5">Job Description:</h2>
            {!! $job->job_description !!}
		</div>
	</div>
@else
	<div class="row">
		<div class="col-12">
			@include('discover.includes.register-gate', ['details' => 'job details'])
		</div>
	</div>
@endauth
