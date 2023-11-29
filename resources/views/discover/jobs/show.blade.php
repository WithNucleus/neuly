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

        <x-entities.entity-show-title-meta title="{{ urlencode($job->name) }}" headingClasses="text-success h2 text-transform-none mb-2 max-width-1000">
            <div class="ms-auto">
                @include('members.follow.button', [
                    'followable_type' => get_class($job),
                    'followable_id' => $job->id,
                    'name' => $job->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @if ($job->status == App\Models\Job::STATUS_ARCHIVED)
            <div class="alert alert-primary d-flex align-items-center rounded-0 border-0 mb-4" role="alert">
                <div class="me-2">
                    <i class="fa-sharp fa-solid fa-box-archive fa-xl text-primary"></i>
                </div>
                <div class="fs-6 text-primary">
                    This job listing is archived and no longer taking applications.
                </div>
            </div>
        @endif

        @include('discover.jobs.data')

        @if(count($related) > 0)
            <x-entities.collapsable-related-entity collapsableId="related-jobs" label="Related Jobs" bgColor="bg-body-secondary" headingColor="text-body-emphasis">
                @foreach($related as $item)
                    <div class="col-12">
                        <x-entities.related.job-card :job="$item" />
                    </div>
                @endforeach
            </x-entities.collapsable-related-entity>
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
