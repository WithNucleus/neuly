@php
    $attrTarget = (isset($embed) && $embed == true) ? 'target="_blank"' : '';
@endphp
<div class="row">
    <div class="col-12">
        <div class="full-width-show-view">

            <div class="page-title-default d-md-flex justify-content-between">
                <h1 class="mb-0 mr-5">Jobs</h1>

                <span class="lead-smaller align-self-end pb-1">
                    Showing {{ $jobs->total() }} Jobs
                </span>
            </div>

            @if(Route::is('embeds.jobs.index'))
                @include('sidebars.embeds')
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

            {{-- Filters --}}
            <?php if (
            isset($filters_location) && $filters_location OR
            isset($filters_company_name) && $filters_company_name OR
            isset($filters_type) && $filters_type
            ) : ?>
            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                <?php if (isset($filters_type) && $filters_type) : ?>
                <span class="mr-3">
                    <i class="fad fa-briefcase text-quaternary"></i>
                    @foreach ($filters_type as $type)
                        {{ $type }}
                        @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                    @endforeach
                </span>
                <?php endif; ?>

                <?php if (isset($filters_location) && $filters_location) : ?>
                <span class="mr-3">
                    <i class="fad fa-map-marker-alt text-info"></i>
                    @foreach ($filters_location as $location)
                        {{ $location }}
                        @if (!$loop->last) <strong class="text-info">/</strong> @endif
                    @endforeach
                </span>
                <?php endif; ?>

                <?php if (isset($filters_company_name) && $filters_company_name) : ?>
                <span class="mr-3">
                    <i class="fad fa-building text-secondarydark"></i>
                    @foreach ($filters_company_name as $company)
                        {{ $company }}
                        @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                    @endforeach
                </span>
                <?php endif; ?>

            </div>
            <?php endif; ?>

            {{-- Jobs --}}
            <ul class="list-group list-group-flush mb-4 @if((isset($embed) && $embed == false) OR !isset($embed))shadow-sm @endif js-items-list">
                @forelse($jobs as $job)
                    <li class="list-group-item d-md-flex">

                        <div class="image mr-5 flex-shrink-0">
                            <a href="{{ route('discover.jobs.show', $job->slug) }}" {!! $attrTarget !!}>
                                <div class="job-org-logo" style="background-image: url('{{ $job->company->entityImageUrl }}');"></div>
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

