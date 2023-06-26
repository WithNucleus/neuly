@extends('layouts.app')

@section('body-class', 'company-show')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <div class="d-md-flex flex-wrap justify-content-between mb-3">
        <h1 class="text-success mb-2 mb-md-0 ">{{ $company->name }}</h1>
        <div class="d-flex flex-wrap align-items-center">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($company),
                    'followable_id' => $company->id,
                    'name' => $company->name
                ])
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
        </div>
    </div>

    @include('discover.includes.status-messages')

	@include('discover.organizations.data')

    @isset($preview)
        @include('discover.includes.update-listing-form', ['entity' => $company])
    @else
        @auth
            <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                <div class="me-4">
                    <small>Last updated: {{ Carbon\Carbon::parse($company->updated_at)->format('M d, Y') }}</small>
                </div>
                <div>
                    @include('discover.includes.update-listing-form', ['entity' => $company])
                </div>
            </div>
        @endauth
    @endisset

	@include('discover.includes.show-end')
    @include('discover.includes.limited-access-modal')

@endsection
