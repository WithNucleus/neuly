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
                        'Clinical Trial Tracker' => false
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

                <h1 class="page-title-default mb-3">Market Comparison</h1>

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
                            </div>
                            <div class="d-inline sort-name text-uppercase">
                                @include('discover.includes.filters.sort-button', [
                                    'asc' => 'valuation',
                                    'desc' => '-valuation',
                                    'label' => 'Valuation'
                                ])
                            </div>
                            <div class="d-inline sort-name text-uppercase">
                                @include('discover.includes.filters.sort-button', [
                                    'asc' => 'founded_date',
                                    'desc' => '-founded_date',
                                    'label' => 'Founded Date'
                                ])
                            </div>
                        </div>
                    @endisset

                    <div class="switch-view mt-2 mb-3 my-md-0 d-flex">
                        <div class="btn-group" role="group" aria-label="Switch Clinical Trial view">
                            <a href="{{ route('discover.organizations') }}" class="btn btn-outline-primary" title="List View" data-toggle="tooltip" data-placement="top"><i class="fad fa-list-ul fa-lg"></i></a>
                            <a href="{{ route('insights.compare-market') }}" class="btn btn-primary" title="Tracker" data-toggle="tooltip" data-placement="top"><i class="fad fa-stream fa-lg"></i></a>
                        </div>
                        <div class="text-right">
                            <button id="open-full-screen-table" class="btn btn-link text-secondarydark" title="Open in Full Screen" data-toggle="tooltip" data-placement="left"><i class="far fa-expand-arrows fa-lg"></i></button>
                        </div>
                    </div>
                </div>

                {{-- Filters --}}
                <?php if (
                isset($filters_type) && $filters_type OR
                isset($filters_valuation_min) && $filters_valuation_min OR
                isset($filters_location) && $filters_location OR
                isset($filters_focus) && $filters_focus
                ) : ?>
                <div class="current-filter-list font-size-small align-self-end mb-3">
                    <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                    <?php if (isset($filters_focus) && $filters_focus) : ?>
                    <span class="mr-3">
                            <i class="fad fa-flask text-secondarydark"></i>
                            @foreach ($filters_focus as $item)
                            {{ $item }}
                            @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                        @endforeach
                        </span>
                    <?php endif; ?>

                    <?php if (isset($filters_type) && $filters_type) : ?>
                        <span class="mr-3">
                            <i class="fad fa-building text-quaternary"></i>
                            @foreach ($filters_type as $item)
                                {{ $item }}
                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                            @endforeach
                        </span>
                    <?php endif; ?>

                    <?php if ((isset($filters_valuation_min) && $filters_valuation_min) AND (isset($filters_valuation_max) && $filters_valuation_max)) : ?>
                        <span class="mr-3">
                            <i class="fad fa-funnel-dollar text-info"></i>
                            ${{ number_format($filters_valuation_min) }} - {{ number_format($filters_valuation_max) }}
                        </span>
                    <?php endif; ?>

                    <?php if (isset($filters_location) && $filters_location) : ?>
                    <span class="mr-3">
                            <i class="fad fa-globe-stand text-primary"></i>
                            @foreach ($filters_location as $item)
                            {{ $item }}
                            @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                        @endforeach
                        </span>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

                @auth
                    @include('discover.insights.market-comparison.comparison-table')
                @else
                    @include('discover.includes.register-gate', ['details' => 'our Clinical Trial Pipeline'])
                @endauth

            </main>
        </div>
    </div>

    @include('footers.mini')

@endsection
