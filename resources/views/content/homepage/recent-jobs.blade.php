<div class="card shadow-sm mb-5">
    <div class="card-header bg-none">
        <h3 class="h1 mb-0 border-bottom">Recent Job Postings</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            @foreach ($jobs as $job)
                <div class="p-3 d-flex d-md-block d-lg-flex @if(!$loop->last) border-bottom @endif">
                    <div class="image mr-3">
                        <a href="{{ route('discover.jobs.show', $job->slug) }}">
                            <div class="job-org-logo" style="background-image: url('{{ $job->owner->entityImageUrl }}');"></div>
                        </a>
                    </div>
                    <div class="text">
                        <p class="lead mb-0">
                            <a href="{{ route('discover.jobs.show', $job->slug) }}" title="{{ $job->job_title }}">{{ $job->job_title }}</a>
                        </p>
                        <p class="mb-0">
                            <span class="text-muted"><i class="fad fa-calendar"></i></span>
                            <strong>{{ \Carbon\Carbon::parse($job->posted_date)->format('M d, Y') }}</strong>
                        </p>

                        @if($job->locations->count() > 0)
                            <p class="mb-0">
                                <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                                @foreach ($job->locations as $location)
                                    {{ $location->name }}@if (!$loop->last) / @endif
                                @endforeach
                            </p>
                        @endif

                        <p class="mb-0">
                            <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                            <span>{{ $job->employment_type }}</span>
                        </p>

                        @if($job->focus->count() > 0)
                            <p class="mb-0">
                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                @foreach($job->focus as $item)
                                    {{ $item->name }}@if (!$loop->last) / @endif
                                @endforeach
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer bg-none text-center">
        <a href="{{ route('discover.jobs') }}" class="btn btn-dark">Browse All Jobs</a>
    </div>
</div>
