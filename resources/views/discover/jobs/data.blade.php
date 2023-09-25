<div class="row">
	<div class="col-12 col-md-8 col-lg-7 order-2 order-md-1">

        <a href="{{ $job->ownerShowUrl }}" class="text-decoration-none" title="{{ $job->owner->name }}">
            <h2 class="h5 mb-3">{{ $job->owner->name }}</h2>
        </a>

        @if($job->locations->count() === 1)
            <div class="mb-3 lead">
                <a href="{{ route('discover.locations.show', $job->locations->first()->slug) }}" class="text-decoration-none text-body-secondary">
                    <i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{ $job->locations->first()->name }}
                </a>
            </div>
        @endif

        <p class="h5 text-body-emphasis">{{ $job->pretty_posted_date }}<span class="mx-2">&bull;</span>{{ $job->employment_type }}</p>

        @if($job->salary)
            <div class="my-3 lead">
                <strong class="text-uppercase">Salary:</strong> ${{ number_format($job->salary) }}
            </div>
        @endif

        @if($job->hourly_rate)
            <div class="my-3 lead">
                <strong class="text-uppercase">Hourly Rate:</strong> ${{ number_format($job->hourly_rate, 2) }}
            </div>
        @endif

        @if($job->focus->count() > 0)
            <div class="d-flex flex-wrap align-items-center mt-3">
                @foreach ($job->focus as $item)
                    <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
                @endforeach
            </div>
        @endif

        @if($job->locations->count() > 1)
            <div class="w-auto d-flex">
                <ul class="list-group list-group-flush lead me-auto w-auto">
                    @foreach ($job->locations as $location)
                        <x-entities.related.location-list-item :location="$location" />
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <div class="col-12 col-md-4 col-lg-5 order-1 order-md-2 mb-3 mb-md-0">
		<div class="text-center">
            <a href="{{ $job->ownerShowUrl }}" class="text-decoration-none" title="{{ $job->owner->name }}">
                <div class="logo-is-contained mb-3" style="background-image: url('{{ $job->owner->entityImageUrl ?? asset('images/image-placeholder-research.png') }}')"></div>
            </a>

            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @auth
                    @if ($job->status == App\Models\Job::STATUS_OPEN)
                        <div class="my-3">
                            <a href="{{ route('discover.jobs.apply', $job->slug) }}" class="btn btn-lg btn-accent">Apply Now</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
	</div>

    <div class="col-12 order-3 mt-4">
        <h2 class="h3">Description</h2>
        <div class="max-width-780">
            {!! $job->job_description !!}
        </div>
        @auth
            @if ($job->status == App\Models\Job::STATUS_OPEN)
                <div class="mt-4">
                    <a href="{{ route('discover.jobs.apply', $job->slug) }}" class="btn btn-lg btn-accent">Apply Now</a>
                </div>
            @endif
        @endauth
    </div>
</div>
