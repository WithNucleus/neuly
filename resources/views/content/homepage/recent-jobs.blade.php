<div class="card shadow-sm mb-5">
    <div class="card-body">
        <h3 class="h2">Most Recent Job Postings</h3>
        <div class="mb-3">
            @foreach ($jobs as $job)
                <div class="p-2 mt-1 d-sm-flex @if(!$loop->last) border-bottom border-tertiary @endif">
                    <div class="image mr-3">
                        <a href="{{ route('discover.jobs.show', $job->slug) }}">
                            <div class="job-org-logo" style="background-image: url('/storage/{{ $job->company->logo }}');"></div>
                        </a>
                    </div>
                    <div class="text">
                        <p class="lead-smaller mb-0">
                            <a href="{{ route('discover.jobs.show', $job->slug) }}">{{ $job->job_title }}</a>
                        </p>
                        <p class="mb-0">
                            <span class="text-danger"><i class="fad fa-calendar-star"></i></span>
                            <strong class="mr-4">{{ \Carbon\Carbon::parse($job->posted_date)->format('M d, Y') }}</strong>

                            @if($job->locations->count() > 0)
                                <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                                @foreach ($job->locations as $location)
                                    {{ $location->name }}@if (!$loop->last),@endif
                                @endforeach
                            @endif
                        </p>

                        @if($job->focus->count() > 0)
                            <p class="mb-0">
                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                @foreach($job->focus as $item)
                                    {{ $item->name }}@if (!$loop->last),@endif
                                @endforeach
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <p class="mb-0 text-center"><a href="{{ route('discover.jobs') }}" class="btn btn-sm btn-dark">See More Jobs</a></p>
    </div>
</div>