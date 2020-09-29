@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>

        <div class="row">
            @include('navbars.tabs-mobile')
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">

                @include('navbars.breadcrumb', [
                    'items' => [
                        'Insights' => route('discover.insights'),
                        'Clinical Trial Pipeline' => false
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Sidebar and Content Area --}}
        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <h1 class="page-title-default mb-3">Clinical Trial Pipeline &amp; Collaborations</h1>

                <div class="d-md-flex justify-content-between align-items-center mb-3">
                    @isset($sort)
                        <div class="sort-container font-size-small">
                            <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                            <div class="d-inline sort-name text-uppercase">
                                @include('discover.includes.filters.sort-button-default-asc', [
                                    'asc' => 'organizations',
                                    'desc' => '-organizations',
                                    'label' => 'Organization'
                                ])
                                @include('discover.includes.filters.sort-button', [
                                    'asc' => 'status',
                                    'desc' => '-status',
                                    'label' => 'Status'
                                ])
                                @include('discover.includes.filters.sort-button', [
                                    'asc' => 'phase',
                                    'desc' => '-phase',
                                    'label' => 'Phase'
                                ])
                            </div>
                        </div>
                    @endisset

                    <div class="switch-view mt-2 mb-3 my-md-0">
                        <div class="btn-group" role="group" aria-label="Switch Clinical Trial view">
                            <a href="{{ route('discover.clinicaltrials') }}" class="btn btn-outline-primary" title="List View"><i class="fad fa-list-ul"></i></a>
                            <a href="{{ route('insights.clinicaltrials.pipeline') }}" class="btn btn-primary" title="Clinical Trial Pipeline"><i class="fad fa-stream"></i></a>
                        </div>
                    </div>
                </div>

                <?php if (
                isset($filters_focus) && $filters_focus OR
                isset($filters_organizations) && $filters_organizations OR
                isset($filters_status) && $filters_status OR
                isset($filters_phases) && $filters_phases
                ) : ?>
                    <div class="current-filter-list font-size-small align-self-end mt-3 mb-3 border-bottom pb-1">
                        <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                        <?php
                        if (isset($filters_focus) && $filters_focus) : ?>
                            <span class="mr-3">
                                <i class="fad fa-flask text-secondarydark"></i>
                                @foreach ($filters_focus as $focus)
                                {{ $focus }}
                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                            @endforeach
                            </span>
                        <?php endif;
                        if (isset($filters_organizations) && $filters_organizations) : ?>
                        <span class="mr-3">
                                <i class="fad fa-building text-secondarydark"></i>
                                @foreach ($filters_organizations as $organization)
                                {{ $organization }}
                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                            @endforeach
                            </span>
                        <?php endif;
                        if (isset($filters_status) && $filters_status) : ?>
                        <span class="mr-3">
                                <i class="fad fa-info-circle text-secondarydark"></i>
                                @foreach ($filters_status as $status)
                                {{ $status }}
                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                            @endforeach
                            </span>
                        <?php endif;
                        if (isset($filters_phases) && $filters_phases) : ?>
                        <span class="mr-3">
                                <i class="fad fa-stream text-secondarydark"></i>
                                @foreach ($filters_phases as $phase)
                                {{ $phase }}
                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                            @endforeach
                            </span>
                        <?php endif;
                        ?>
                    </div>
                <?php endif; ?>

                @auth
                    @include('discover.insights.clinicaltrials.clinicaltrials-table')
                @else
                    @include('discover.includes.register-gate', ['details' => 'our Clinical Trial Pipeline'])
                @endauth

            </main>
        </div>
    </div>

    @include('footers.mini')

    @include('sidebars.filters.scripts')

@endsection
