@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mr-4 flex-shrink-1">{{ $job->job_title }}</h1>

        <div class="dashboard-actions-container flex-shrink-0 m-2 float-right">

            @include('members.bookmarks.add-button', [
                'entity' => $entity,
                'entity_id' => $job->id,
                'name' => $job->job_title,
                'bookmarks' => $bookmarks
            ])
            
            @include('members.follow.add-button', [
                'entity' => 'jobs',
                'entity_id' => $job->id,
                'name' => $job->job_title
            ])
        </div>
    </div>

    @include('discover.jobs.data')

    @auth
        <p class="mb-0 mr-2">
            <a href="{{ route('discover.jobs.apply', $job->slug) }}" class="btn btn-lg btn-danger">Apply Now</a>
        </p>
    @endauth

    @if(count($related) > 0)

        <h4 class="mt-5">Related Jobs:</h4>
        <div class="card-deck mt-2">
            @foreach($related as $index => $item)
                <div class="card">
                    <div class="card-header"><a href="{{ route('discover.organizations.show', ['slug' => $item->slug]) }}">{{$item->job_title}}</a></div>
                    <div class="card-body">
                        {!! $item->job_description !!}
                    </div>
                    <div class="card-footer">
                        <strong>Focus:</strong><br>
                        @foreach ($item->focus as $focus)
                            <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>@if (!$loop->last),@endif
                        @endforeach
                    </div>
                </div>
                @if($index%2 === 1)
        </div>
        <div class="card-deck mt-4">
            @endif
            @endforeach
        </div>
    @endif

    @include('discover.includes.show-end')

@endsection