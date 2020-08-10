@extends('layouts.app')

@section('body-class', 'page-companies bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        {{-- Discover Tabs Desktop --}}
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>
    </div>

    {{-- Discover Tabs Mobile --}}
    @include('navbars.tabs-mobile')

    <div class="container-fluid">
        {{-- Breadcrumbs --}}
        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                @include('navbars.breadcrumb', [
                    'items' => [
                        'Organizations' => false
                    ]           
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between">
                                <h1 class="mb-0 mr-5">Organizations</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $companies->total() }} Organizations
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button-default', [
                                            'asc' => 'name',
                                            'desc' => '-name',
                                            'label' => 'Name'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'type',
                                            'desc' => '-type',
                                            'label' => 'Type'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'date',
                                            'desc' => '-date',
                                            'label' => 'Date Added'
                                        ])

                                    </div>
                                </div>
                            @endisset

                            {{-- Filters --}}
                            <?php if (
                                isset($filters_location) && $filters_location OR 
                                isset($filters_company_name) && $filters_company_name OR 
                                isset($filters_employment_type) && $filters_employment_type
                                ) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <?php if (isset($filters_location) && $filters_location) : ?>
                                    <span class="mr-3">
                                        <i class="fad fa-map-marker-alt text-info"></i>
                                        @foreach ($filters_location as $location)
                                            {{ $location }}
                                            @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                        @endforeach
                                    </span>
                                <?php endif; ?>

                                <?php if (isset($filters_type) && $filters_type) : ?>
                                    <span class="mr-3">
                                        <i class="fad fa-funnel-dollar text-quaternary"></i>
                                        @foreach ($filters_type as $type)
                                            {{ $type }}
                                            @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                        @endforeach
                                    </span>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>

                            {{-- Companies --}}
                            <div class="d-flex flex-wrap">
                                @forelse($companies as $company)
                                    <div class="col-12 col-md-6 col-xl-4 mb-5">
                                        <div class="card shadow-sm">
                                            <div class="pt-4 text-center">

                                                @if($company->jobs->count() > 0) <a href="{{ route('discover.organizations.jobs', $company->slug) }}"><span class="hiring-badge font-weight-bold"><i class="fad fa-briefcase"></i> HIRING</span></a> @endif

                                                @if($company->events->count() > 0) <a href="{{ route('discover.organizations.events', $company->slug) }}"><span class="events-badge font-weight-bold"><i class="fad fa-calendar-day"></i> EVENTS</span></a> @endif

                                                <a href="{{ route('discover.organizations.show', $company->slug) }}" class="text-decoration-none">
                                                @if ($company->logo == '')
                                                    <div class="bg-brains logo-is-contained rounded">
                                                        {{-- <span class="lead-smaller m-0 text-white px-2">{{ $company->name }}</span> --}}
                                                    </div>
                                                    <p class="my-3 lead">
                                                        <a href="{{ route('discover.organizations.show', $company->slug) }}" class="text-decoration-none">{{ $company->name }}</a>
                                                    </p>
                                                @else
                                                    <div class="logo-is-contained" style="background-image: url('/storage/{{ $company->logo }}')" data-toggle="tooltip" data-placement="top" title="{{ $company->name }}"></div>
                                                    <p class="my-3 lead">
                                                        <a href="{{ route('discover.organizations.show', $company->slug) }}" class="text-decoration-none">{{ $company->name }}</a>
                                                    </p>
                                                @endif
                                                </a>

                                                <ul class="list-group list-group-flush text-left border-top">
                                                    <li class="list-group-item">
                                                        <i class="fad fa-building text-quaternary"></i> {{ $company->ownership }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="truncate-this">
                                                            <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                                            @if($company->focus->count() > 0)
                                                                @foreach ($company->focus as $item)
                                                                    {{ $item->name }}@if (!$loop->last) &bull; @endif
                                                                @endforeach
                                                            @else
                                                                <a href="mailto:support@neuly.com">Update Focus</a>
                                                            @endif
                                                        </span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="truncate-this">
                                                            <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                                            @if($company->locations->count() > 0)
                                                                @foreach ($company->locations as $location)
                                                                    {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                                @endforeach
                                                            @else
                                                                <a href="mailto:support@neuly.com">Update Location</a>
                                                            @endif
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            {{-- <div class="card-footer bg-black-25 font-size-small d-flex justify-content-between">
                                                <span class="flex-shrink-0 mr-3">
                                                    <i class="fad fa-funnel-dollar text-quaternary"></i> {{ $company->type }}
                                                </span>
                                                @if($company->locations->count() > 0)
                                                    <span class="truncate-this-small">
                                                        <span class="text-dark"><i class="fad fa-globe-stand"></i></span>
                                                        @foreach ($company->locations as $location)
                                                            {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                        @endforeach
                                                    </span>
                                                @else
                                                    &nbsp;
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>

                                @empty
                                    <div class="w-100">
                                        <p class="lead mb-0">
                                            No companies match your search criteria. 
                                        </p>
                                    </div>
                                @endforelse
                            </div>

                            {{ $companies->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection