<div class="col-12 max-width-1300 mb-4">
    <x-entities.entity-logo-card url="{{ route('discover.jobs.show', $job->slug) }}" linkClasses="py-2 text-start" cardClasses="border-0" cardBodyClasses="bg-body-tertiary border-0">
        <div class="d-lg-flex align-items-start">
            @if($withOwner)
                <div class="medium-square-card bg-white border me-lg-4 mb-4 mb-lg-0">
                    <div class="logo-is-contained" style="background-image: url('{{ $job->owner->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
                </div>
            @endif
            <div class="text-content flex-grow-1 d-flex flex-column justify-content-between">
                <div>
                    <div class="h4 text-success">{{ $job->name }}</div>

                    @if($job->locations->count() > 0)
                        <div class="mt-3 lead text-body-emphasis">
                            <span>{{ $job->locations->first()->name }}</span>
                            @if($job->locations->count() > 1)
                                <span class="text-body-secondary small">(and more)</span>
                            @endif
                        </div>
                    @endif

                    @if($job->focus->count() > 0)
                        <div class="d-flex flex-wrap lead">
                            @foreach($job->focus as $focus)
                                <span class="mt-3 badge bg-body-secondary text-body me-3">{{ $focus->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="d-xl-flex flex-wrap mt-3 text-body-secondary fw-bold text-uppercase">
                    <div class="me-4">
                        @foreach($job->employmentTypes as $employmentType)
                            <span>{{ $employmentType->name }}</span>
                            @if(!$loop->last) <span class="mx-1">/</span> @endif
                        @endforeach
                    </div>
                    <div class="me-4">{{ $job->pretty_posted_date }}</div>
                    @if($job->salary)
                        <div class="me-4">
                            <span>${{ number_format($job->salary) }}</span>
                            @if($job->salary_max)
                                <span>&ndash;</span>
                                <span>${{ number_format($job->salary_max) }}</span>
                            @endif
                        </div>
                    @endif
                    @if($job->hourly_rate)
                        <div>${{ number_format($job->hourly_rate) }}/hour</div>
                    @endif
                </div>
                @if($job->status === \App\Models\Job::STATUS_ARCHIVED)
                    <div class="mt-3 small text-uppercase text-primary fst-italic fw-bold">
                        This job is archived
                    </div>
                @endif
            </div>
        </div>
    </x-entities.entity-logo-card>
</div>
