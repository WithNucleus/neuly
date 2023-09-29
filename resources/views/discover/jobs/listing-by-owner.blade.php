@extends('layouts.entity-show')

@section('breadcrumbs')
    @if (Route::is('discover.organizations.jobs'))
        @include('navbars.breadcrumb', [
            'items' => [
                'Organizations' => route('discover.organizations'),
                $owner->name  => route('discover.organizations.show', $owner->slug),
                'Jobs' => false
            ]
        ])
    @endif

    @if(Route::is('discover.investors.jobs'))
        @include('navbars.breadcrumb', [
            'items' => [
                'Investors' => route('discover.investors'),
                $owner->name  => route('discover.investors.show', $owner->slug),
                'Jobs' => false
            ]
        ])
    @endif
@endsection

@section('content')

    <div class="container py-4">
        <h1>Jobs at {{ $owner->name }}</h1>

        @isset($jobs)
            <div class="list-group list-group-flush">
                @forelse($jobs as $job)
                    <div class="list-group-item py-3 px-0">

                        <h2 class="h4">
                            <a href="{{ route('discover.jobs.show', $job->slug) }}" class="text-decoration-none">{{ $job->job_title }}</a>
                        </h2>

                        <div>
                            <span class="text-danger"><i class="fad fa-calendar-star"></i></span>
                            <strong class="mr-4">{{ \Carbon\Carbon::parse($job->posted_date)->format('M d, Y') }}</strong>
                        </div>

                        <div>
                            <span><i class="fad fa-watch"></i></span>
                            <span class="mr-4">{{ $job->employment_type }}</span>
                        </div>

                        @if($job->locations->count() > 0)
                            <div>
                                <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                                @foreach ($job->locations as $location)
                                    {{ $location->name }}@if (!$loop->last),@endif
                                @endforeach
                            </div>
                        @endif

                        @if($job->focus->count() > 0)
                            <div>
                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                @foreach($job->focus as $item)
                                    {{ $item->name }}@if (!$loop->last),@endif
                                @endforeach
                            </div>
                        @endif

                    </div>
                @empty
                    There are currently no open jobs at {{ $owner->name }}
                @endforelse
            </div>
        @endisset
    </div>

@endsection
