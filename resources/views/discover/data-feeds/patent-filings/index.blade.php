@extends('layouts.app')

@section('body-class', 'page-news bg-light')

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
                        'Patent Filings' => false
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

                            <div class="page-title-default d-md-flex justify-content-between mb-4">
                                <h1 class="mb-0 mr-5">Patent Filings</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $patentFilings->total() }} Patent Filings
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button-default', [
                                            'asc' => 'date',
                                            'desc' => '-date',
                                            'label' => 'Date'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'name',
                                            'desc' => '-name',
                                            'label' => 'Name'
                                        ])

                                    </div>
                                </div>
                            @endisset

                            {{-- Filters --}}
                            <?php if (isset($filters_focus) && $filters_focus) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <span class="mr-3">
                                    <i class="fad fa-map-marker-alt text-info"></i>
                                    @foreach ($filters_focus as $focus)
                                        {{ $focus }}
                                        @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                    @endforeach
                                </span>

                            </div>
                            <?php endif; ?>

                            {{-- Patents --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($patentFilings as $patentFiling)
                                    <li class="list-group-item py-4">
                                        <h2 class="h4">
                                            <a href="{{ $patentFiling->url }}" target="_blank" rel="noopener noreferrer">
                                                @if ($patentFiling->companies->count() > 0 OR $patentFiling->people->count() > 0)
                                                    @foreach ($patentFiling->companies as $item)
                                                        {{ $item->name }}@if (!$loop->last) / @endif
                                                    @endforeach
                                                    @if ($patentFiling->companies->count() > 0 AND $patentFiling->people->count() > 0)
                                                        /
                                                    @endif
                                                    @foreach ($patentFiling->people as $item)
                                                        {{ $item->name }}@if (!$loop->last) / @endif
                                                    @endforeach
                                                @else
                                                    {{ $patentFiling->summary }}
                                                @endif
                                            </a>
                                        </h2>

                                        <div class="lead mb-2 text-muted">
                                            {{ Carbon\Carbon::parse($patentFiling->date)->format('M d, Y') }} - {{ $patentFiling->summary }}
                                        </div>
                                        <p class="mb-2 patent-filing-content">
                                            {{ $patentFiling->content }}
                                        </p>
                                        @if($patentFiling->focus->count() > 0)
                                            <p class="text-secondarydark mb-0">
                                                <i class="fad fa-flask"></i>
                                                @foreach ($patentFiling->focus as $item)
                                                    {{ $item->name }}@if (!$loop->last) / @endif
                                                @endforeach
                                            </p>
                                        @endif
                                        @if($patentFiling->people->count() > 0)
                                            <p class="text-info my-2">
                                                <i class="fad fa-user"></i>
                                                @foreach ($patentFiling->people as $item)
                                                    {{ $item->name }}@if (!$loop->last) / @endif
                                                @endforeach
                                            </p>
                                        @endif
                                    </li>
                                @empty
                                    <li class="list-group-item py-4">
                                        <p class="lead mb-0">
                                            No patent filings match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $patentFilings->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
