@extends('layouts.app')

@section('body-class', 'page-locations bg-light')

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
                        'Locations' => false
                    ]
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between">
                                <h1 class="mb-0 mr-5">Locations</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $locations->total() }} Locations
                                </span>
                            </div>

                            <div class="d-md-flex justify-content-between align-items-center">
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
                                                'asc' => 'city',
                                                'desc' => '-city',
                                                'label' => 'City'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'region',
                                                'desc' => '-region',
                                                'label' => 'Region'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'country',
                                                'desc' => '-country',
                                                'label' => 'Country'
                                            ])

                                        </div>
                                    </div>
                                @endisset

                                <div class="switch-view ml-auto mt-2 mb-3 my-md-0 d-flex">
                                    <div class="btn-group" role="group" aria-label="Switch Location view">
                                        <a href="{{ route('discover.locations') }}" class="btn btn-primary" title="List View" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-list-ul fa-lg"></i>
                                        </a>
                                        <a href="{{ route('discover.locations.maps.global') }}" class="btn btn-outline-primary" title="Map View" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-map"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Filters --}}
                            <?php if (
                                isset($filters_location) && $filters_location OR
                                isset($filters_countries) && $filters_countries OR
                                isset($filters_company_name) && $filters_company_name
                                ) : ?>
                            <div class="current-filter-list font-size-small align-self-end">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <?php if (isset($filters_countries) && $filters_countries) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-globe-stand text-info"></i>
                                            @foreach ($filters_countries as $country)
                                                {{ $country }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_location) && $filters_location) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-map-marker-alt text-info"></i>
                                            @foreach ($filters_location as $location)
                                                {{ $location }}
                                                @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_company_name) && $filters_company_name) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-building text-secondarydark"></i>
                                            @foreach ($filters_company_name as $company)
                                                {{ $company }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>

                            {{-- Locations --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm mt-4">
                                @forelse($locations as $location)
                                    <li class="list-group-item p-4 d-md-flex">

                                        <div class="text">
                                            <p class="lead-smaller mb-1 mt-1">
                                                <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>
                                            </p>

                                            @if($location->companies->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-building"></i></span>
                                                    @foreach ($location->companies as $company)
                                                        {{ $company->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($location->investors->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-primary"><i class="fad fa-hands-usd"></i></span>
                                                    @foreach ($location->investors as $investor)
                                                        {{ $investor->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($location->people->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                    @foreach ($location->people as $person)
                                                        {{ $person->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($location->jobs->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                    @foreach ($location->jobs as $job)
                                                        {{ $job->job_title }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($location->clinicaltrials->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-secondarydark"><i class="fad fa-microscope"></i></span>
                                                    @foreach ($location->clinicaltrials as $clinicaltrial)
                                                        {{ $clinicaltrial->title }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                        </div>

                                    </li>

                                @empty
                                    <li class="list-group-item">
                                        <p class="lead mb-0">
                                            No locations match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $locations->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
