<ul class="list-group">
    @forelse($jobs as $job)
        <li class="list-group-item d-md-flex">
            <div class="logo-icon widget-expandable-details" style="background-image: url('{{ $job->owner->entityImageUrl }}');"></div>
            <div class="text">
                <p class="mb-1 font-weight-bold">
                    <a href="{{ route('discover.jobs.show', $job->slug) }}">
                        {{ $job->job_title }}
                    </a>
                </p>
                <div class="widget-expandable-details">
                    @if($job->locations->count() > 0)
                        <p class="mb-1">
                            <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                            @foreach ($job->locations as $location)
                                {{ $location->name }}@if (!$loop->last),@endif
                            @endforeach
                        </p>
                    @endif

                    @if($job->focus->count() > 0)
                        <p class="mb-1">
                            <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                            @foreach($job->focus as $item)
                                {{ $item->name }}@if (!$loop->last),@endif
                            @endforeach
                        </p>
                    @endif

                    <div class="d-flex flex-wrap">
                        <div class="mr-5">
                            <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                            <span>{{ $job->employment_type }}</span>
                        </div>

                        <div>
                            <span class="text-info"><i class="fad fa-calendar-alt"></i></span>
                            <strong>{{ \Carbon\Carbon::parse($job->posted_date)->diffForHumans() }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @empty
        <li class="list-group-item">
            <p class="mb-0">
                No jobs match your search criteria.
            </p>
        </li>
    @endforelse
</ul>
