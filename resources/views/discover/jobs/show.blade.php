@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Jobs' => route('discover.jobs'),
            $job->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ urlencode($job->name) }}" headingClasses="text-success h2 text-transform-none mb-2 max-width-780">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($job),
                    'followable_id' => $job->id,
                    'name' => $job->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @if ($job->status == App\Models\Job::STATUS_ARCHIVED)
            <div class="h5 mb-4 bg-warning-subtle pt-2 pb-1 px-2 d-inline-block">
                <i class="fa-sharp fa-regular fa-circle-exclamation me-2"></i>This job listing is no longer active or it's been a long time since it was posted.
            </div>
        @endif

        @include('discover.jobs.data')

        @if(count($related) > 0)
            <h2 class="h3 mt-5 ">Related Jobs:</h2>
            <div class="row">
                @foreach($related as $item)
                    <x-entities.related.job-card :job="$item" withOwner="true" />
                @endforeach
            </div>
        @endif

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($job->updated_at)->format('M d, Y') }}
            </div>
            @can('edit jobs')
                <div>
                    <a href="{{ route('job.edit', $job->id) }}" class="text-secondary-emphasis">Edit Job</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $job])
            </div>
        </div>
    </div>

@endsection
