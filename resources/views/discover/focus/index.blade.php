@extends('layouts.app')

@section('body-class', 'page-focus bg-light')

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
                        'Focus' => false
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
                                <h1 class="mb-0 mr-5">Focus</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $focus_items->total() }} Focus
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button-default', [
                                            'asc' => '-name',
                                            'desc' => 'name',
                                            'label' => 'Name'
                                        ])

                                    </div>
                                </div>
                            @endisset

                            {{-- Filters --}}
                            <?php if (
                                isset($filters_focus) && $filters_focus OR
                                isset($filters_countries) && $filters_countries OR
                                isset($filters_company_name) && $filters_company_name
                                ) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
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

                                <?php if (isset($filters_focus) && $filters_focus) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-map-marker-alt text-info"></i>
                                            @foreach ($filters_focus as $focus)
                                                {{ $focus }}
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

                            {{-- Focus --}}
                            <div class="">
                                @forelse($focus_items as $focus)
                                <div class="row">
                                    <div class="col-md-10 col-lg-9 col-xl-7 mb-4">
                                        <div class="card shadow-sm">
                                            <div class="pt-4">

                                                <p class="px-4 h4 font-normal mb-1 mt-1">
                                                    <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>
                                                </p>

                                                <ul class="list-group list-group-flush text-left">

                                                    @if ($focus->companies->count() > 0)
                                                    <li class="list-group-item">
                                                        <span class="truncate-this-xl">
                                                            <i class="fad fa-building text-quaternary"></i>
                                                            @foreach ($focus->companies as $item)
                                                                {{ $item->name }}@if (!$loop->last) &bull; @endif
                                                            @endforeach
                                                        </span>
                                                    </li>
                                                    @endif

                                                    @if ($focus->jobs->count() > 0)
                                                    <li class="list-group-item">
                                                        <span class="truncate-this-xl">
                                                            <i class="fad fa-briefcase text-danger"></i>
                                                            @foreach ($focus->jobs as $item)
                                                                {{ $item->job_title }}@if (!$loop->last) &bull; @endif
                                                            @endforeach
                                                        </span>
                                                    </li>
                                                    @endif

                                                    @if ($focus->research->count() > 0)
                                                    <li class="list-group-item">
                                                        <span class="truncate-this-xl">
                                                            <i class="fad fa-microscope text-primary"></i>
                                                            @foreach ($focus->research as $item)
                                                                {{ $item->name }}@if (!$loop->last) &bull; @endif
                                                            @endforeach
                                                        </span>
                                                    </li>
                                                    @endif

                                                    @if ($focus->clinicaltrials->count() > 0)
                                                    <li class="list-group-item">
                                                        <span class="truncate-this-xl">
                                                            <i class="fad fa-stethoscope text-info"></i>
                                                            @foreach ($focus->clinicaltrials as $item)
                                                                {{ $item->title }}@if (!$loop->last) &bull; @endif
                                                            @endforeach
                                                        </span>
                                                    </li>
                                                    @endif
                                                </ul>

                                                {{-- @if($focus->companies->count() > 0)
                                                    <p class="mb-1 truncate-this-xl">
                                                        <span class="text-quaternary"><i class="fad fa-building"></i></span>
                                                        @foreach ($focus->companies as $company)
                                                            {{ $company->name }}@if (!$loop->last) &bull; @endif
                                                        @endforeach
                                                    </p>
                                                @endif

                                                @if($focus->jobs->count() > 0)
                                                    <p class="mb-1 truncate-this-xl">
                                                        <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                        @foreach ($focus->jobs as $job)
                                                            {{ $job->job_title }}@if (!$loop->last) &bull; @endif
                                                        @endforeach
                                                    </p>
                                                @endif

                                                @if($focus->clinicaltrials->count() > 0)
                                                    <p class="mb-1 truncate-this-xl">
                                                        <span class="text-secondarydark"><i class="fad fa-microscope"></i></span>
                                                        @foreach ($focus->clinicaltrials as $clinicaltrial)
                                                            {{ $clinicaltrial->title }}@if (!$loop->last) &bull; @endif
                                                        @endforeach
                                                    </p>
                                                @endif --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @empty
                                    <div class="w-100">
                                        <p class="lead mb-0">
                                            No focus categories match your search criteria.
                                        </p>
                                    </div>
                                @endforelse
                            </div>

                            {{ $focus_items->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
