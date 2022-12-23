@php
    $attrTarget = (isset($embed) && $embed == true) ? 'target="_blank"' : '';
@endphp
<div class="row">
    <div class="col-12">
        <div class="full-width-show-view">

            <div class="page-title-default d-md-flex justify-content-between">
                <h1 class="mb-0 mr-5">Jobs @if(Route::is('discover.jobs-archive')) Archive @endif</h1>

                <span class="lead-smaller align-self-end pb-1">
                    Showing {{ $jobs->total() }} Jobs
                </span>
            </div>

            @if(Route::is('embeds.jobs.index'))
                @include('sidebars.embeds')
            @endif

            @if(Route::is('discover.jobs-archive'))
                <p class="my-3 text-secondarydark font-weight-bold">These job listings are no longer active or it's been a long time since they were posted. We're keeping them up so you can see how the industry has been hiring.</p>
            @endif

            {{-- Sorting --}}
            @isset($sort)
                <div class="sort-container font-size-small mt-3 mb-3">
                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                    <div class="d-inline sort-name text-uppercase">

                        @include('discover.includes.filters.sort-button-default', [
                            'asc' => 'date',
                            'desc' => '-date',
                            'label' => 'Posted Date'
                        ])

                        @include('discover.includes.filters.sort-button', [
                            'asc' => 'title',
                            'desc' => '-title',
                            'label' => 'Job Title'
                        ])

                    </div>
                </div>
            @endisset


            @include('includes.filters.active-list')

            {{-- Jobs --}}
            <ul class="list-group list-group-flush mb-4 @if((isset($embed) && $embed == false) OR !isset($embed))shadow-sm @endif js-items-list">
                @forelse($jobs as $job)
                    <li class="list-group-item d-md-flex">

                        <div class="image mr-5 flex-shrink-0">
                            <a href="{{ route('discover.jobs.show', $job->slug) }}" {!! $attrTarget !!}>
                                <div class="job-org-logo" style="background-image: url('{{ $job->owner->entityImageUrl }}');"></div>
                            </a>
                        </div>

                        <div class="text flex-grow-1">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-7">
                                    <p class="lead-smaller mb-0">
                                        <a href="{{ route('discover.jobs.show', $job->slug) }}" {!! $attrTarget !!}>
                                            {{ $job->job_title }}
                                        </a>
                                    </p>

                                    @if($job->locations->count() > 0)
                                        <div>
                                            <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                            @foreach ($job->locations as $location)
                                                {{ $location->name }}@if (!$loop->last),@endif
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($job->focus->count() > 0)
                                        <div>
                                            <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                            @foreach($job->focus as $item)
                                                {{ $item->name }}@if (!$loop->last),@endif
                                            @endforeach
                                        </div>
                                    @endif

                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-lg-flex justify-content-between flex-wrap">
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
                        <p class="lead mb-0">
                            No jobs match your search criteria.
                        </p>
                    </li>
                @endforelse
            </ul>

            {{ $jobs->links() }}
        </div>
    </div>
</div>

