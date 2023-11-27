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
            <div class="row">
                @forelse($jobs as $job)
                    <x-entities.related.job-card :job="$job" withOwner="0" />
                @empty
                    <div class="col-12">
                        There are currently no open jobs at {{ $owner->name }}
                    </div>
                @endforelse
            </div>
        @endisset
    </div>

@endsection
