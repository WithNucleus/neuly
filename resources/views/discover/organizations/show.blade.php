@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <p class="dashboard-actions-container m-2 float-right">

        @include('members.bookmarks.add-button', [
            'entity' => $entity,
            'entity_id' => $company->id,
            'name' => $company->name,
            'bookmarks' => $bookmarks
        ])
		
		@include('members.follow.add-button', [
            'entity' => $entity,
            'entity_id' => $company->id,
            'name' => $company->name
        ])
    </p>

    @if($company->jobs->count() > 0 OR $company->events->count() > 0)
    	<p class="text-uppercase m-2 float-right font-weight-bold">
            @if ($company->jobs->count() > 0)
        		<a href="{{ route('discover.organizations.jobs', $company->slug) }}" class="text-decoration-none mr-2 text-danger">
                    <i class="fad fa-briefcase"></i> Hiring
                </a>
            @endif

            @if($company->events->count() > 0)
                <a href="{{ route('discover.organizations.events', $company->slug) }}" class="text-decoration-none text-secondarydark">
                    <i class="fad fa-calendar-alt"></i> Events
                </a>
            @endif
    	</p>
    @endif

	<h1>{{ $company->name }}</h1>

    @include('discover.includes.status-messages')

	@include('discover.organizations.data')

	<p class="mb-0">
		<small>Last updated: {{ Carbon\Carbon::parse($company->updated_at)->format('M d, Y') }}</small>
	</p>

	@include('discover.includes.show-end')

@endsection