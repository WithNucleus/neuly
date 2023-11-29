<div class="row">
	<div class="col-12 col-md-8 col-lg-7 order-2 order-md-1">

        <div class="bg-body-tertiary px-3 py-2">
            <table class="table lead job-details-table">
                <tr>
                    <th class="text-uppercase">Employer:</th>
                    <td>
                        <a href="{{ $job->ownerShowUrl }}">{{ $job->owner->name }}</a>
                    </td>
                </tr>
                <tr>
                    <th class="text-uppercase">Date Posted:</th>
                    <td>{{ $job->pretty_posted_date }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase">Employment:</th>
                    <td>
                        @foreach($job->employmentTypes as $employmentType)
                            <span>{{ $employmentType->name }}</span>
                            @if(!$loop->last) <span class="mx-1">/</span> @endif
                        @endforeach
                    </td>
                </tr>
                @if($job->salary OR $job->hourly_rate)
                    <tr>
                        <th class="text-uppercase">Compensation:</th>
                        <td>
                            @if($job->salary)
                                <span>${{ number_format($job->salary) }}</span>
                                @if($job->salary_max)
                                    <span>&ndash;</span>
                                    <span>${{ number_format($job->salary_max) }}</span>
                                @endif
                                <span> / year</span>
                            @endif
                            @if($job->hourly_rate)
                                <div>
                                    <span>${{ number_format($job->hourly_rate, 2) }}</span>
                                    <span> / hour</span>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th class="text-uppercase">Focus / Industry:</th>
                    <td>
                        @foreach($job->focus as $focus)
                            <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>
                            @if(!$loop->last) <span class="mx-1">/</span> @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-uppercase">Location:</th>
                    <td>
                        @foreach ($job->locations as $location)
                            <div>{{ $location->name }}</div>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <div class="col-12 col-md-4 col-lg-5 order-1 order-md-2 mb-3 mb-md-0">
		<div class="text-center">
            @if($job->owner->entityImageUrl)
                <a href="{{ $job->ownerShowUrl }}" class="text-decoration-none bg-white border d-block max-width-400 mx-auto" title="{{ $job->owner->name }}">
                    <div class="logo-is-contained mb-3" style="background-image: url('{{ $job->owner->entityImageUrl ?? asset('images/image-placeholder-research.png') }}')"></div>
                </a>
            @else
                <a href="{{ $job->ownerShowUrl }}" title="{{ $job->owner->name }}" class="text-decoration-none">
                    <img src="{{ asset('images/image-placeholder-research.png') }}" alt="{{ $job->owner->name }}" class="max-width-360">
                    <div class="mt-2 text-uppercase h6 mb-0">{{ $job->owner->name }}</div>
                </a>
            @endif

            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @auth
                    @if ($job->status == App\Models\Job::STATUS_OPEN)
                        <div class="my-3">
                            <livewire:public.entities.show.job-apply-widget jobId="{{ $job->id }}"/>
                        </div>
                    @endif
                @else
                    <div class="my-3 fs-6 max-width-400 mx-auto">
                        <a href="{{ route('register') }}">Signup</a> or <a href="{{ route('login') }}">Login</a> to apply for this job &amp; others in the psychedelic industry
                    </div>
                @endauth
            </div>
        </div>
	</div>

    <div class="col-12 order-3 mt-5">
        <x-entities.collapsable-related-entity collapsableId="job-description" label="Job Description" bgColor="bg-body-secondary" headingColor="text-body-emphasis">
            <div class="col-12">
                <div class="max-width-780">
                    {!! $job->job_description !!}
                </div>
            </div>
        </x-entities.collapsable-related-entity>

        <div class="max-width-780">
            @auth
                @if ($job->status == App\Models\Job::STATUS_OPEN)
                    <div class="my-5">
                        <livewire:public.entities.show.job-apply-widget jobId="{{ $job->id }}"/>
                    </div>
                @endif
            @else
                <div class="my-5 bg-primary-subtle py-5 px-3 text-center">
                    <div class="h2 text-primary">Interested in this job?</div>
                    <div class="fs-5 max-width-500 mx-auto text-body-emphasis">Gain access to the psychedelic industry’s most robust platform for free.</div>
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-4">Signup</a>
                        <a href="{{ route('login') }}" class="btn btn-success text-white btn-lg">Login</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
