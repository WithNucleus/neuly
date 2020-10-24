@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mr-4 flex-shrink-1">{{ $job->job_title }}</h1>

        <div class="dashboard-actions-container flex-shrink-0 m-2 float-right">
            @include('members.follow.button', [
                'followable_type' => get_class($job),
                'followable_id' => $job->id,
                'name' => $job->job_title,
            ])
        </div>
    </div>

    @include('discover.jobs.data')

    @auth
        <p class="mt-2 mb-0 mr-2">
            <a href="{{ route('discover.jobs.apply', $job->slug) }}" class="btn btn-lg btn-danger">Apply Now</a>
        </p>
    @endauth

    @if(count($related) > 0)
        <h2 class="h3 mt-5 ">Related Jobs:</h2>
        <div class="row">
            @foreach($related as $index => $item)
                <div class="col-12 col-md-6 mb-3">
                    <div class="border-top pt-3 d-md-flex">
                        <div class="image mr-5 flex-shrink-0">
                            <div class="job-org-logo" style="background-image: url('/storage/{{ $item->company->logo }}');"></div>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="font-normal lead">
                                <a href="{{ route('discover.organizations.show', ['slug' => $item->slug]) }}">{{$item->job_title}}</a>
                            </h3>
                            @if($item->locations->count() > 0)
                                <p class="mb-0">
                                    <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                    @foreach ($item->locations as $location)
                                        {{ $location->name }}@if (!$loop->last),@endif
                                    @endforeach
                                </p>
                            @endif
                            @if($item->focus->count() > 0)
                                <p class="mb-0">
                                    <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                    @foreach ($item->focus as $focus)
                                        {{ $focus->name }}@if (!$loop->last) / @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @include('discover.includes.show-end')

@endsection
