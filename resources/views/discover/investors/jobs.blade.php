@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <h1>Jobs at {{ $investor->name }}</h1>

    @isset($jobs)
        <div class="list-group list-group-flush">
            @forelse($jobs as $job)
                <div class="list-group-item">

                    <p class="lead-smaller mb-0">
                        <a href="{{ route('discover.jobs.show', $job->slug) }}">{{ $job->job_title }}</a>
                    </p>

                    <div>
                        <span class="text-danger"><i class="fad fa-calendar-star"></i></span>
                        <strong class="mr-4">{{ \Carbon\Carbon::parse($job->posted_date)->format('M d, Y') }}</strong>
                    </div>

                    <div>
                        <span class="text-black-50"><i class="fad fa-watch"></i></span>
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
                No jobs
            @endforelse
        </div>
    @endisset

    @include('discover.includes.show-end')

@endsection
