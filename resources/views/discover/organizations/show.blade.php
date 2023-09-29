@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Organizations' => route('discover.organizations'),
            $company->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $company->name }}">
            <div class="me-3">
                @include('members.follow.button')
            </div>

            @if ($company->jobs->count() > 0)
                <a href="{{ route('discover.organizations.jobs', $company->slug) }}" class="text-decoration-none text-uppercase me-3 text-danger">
                    <i class="fad fa-briefcase"></i> Hiring
                </a>
            @endif

            @if($company->events->count() > 0)
                <a href="{{ route('discover.organizations.events', $company->slug) }}" class="text-decoration-none text-uppercase text-secondarydark">
                    <i class="fad fa-calendar-alt"></i> Events
                </a>
            @endif
        </x-entities.entity-show-title-meta>

        @include('discover.organizations.data')

        @include('discover.includes.related.organization')

        @isset($preview)
            @include('discover.includes.update-listing-form', ['entity' => $company])
        @else
            @auth
                <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
                    <div class="me-4">
                        Last updated: {{ Carbon\Carbon::parse($company->updated_at)->format('M d, Y') }}
                    </div>
                    @can('edit companies')
                        <div>
                            <a href="{{ route('company.edit', $company->id) }}" class="text-secondary-emphasis">Edit Company</a>
                        </div>
                    @endcan
                    <div>
                        @include('discover.includes.update-listing-form', ['entity' => $company])
                    </div>
                </div>
            @endauth
        @endisset
    </div>

@endsection
