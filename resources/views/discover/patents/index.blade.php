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
                        'Patents' => false
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
                                <h1 class="mb-0 mr-5">Patents</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $patents->total() }} Patents
                                </span>
                            </div>

                            <div class="d-md-flex justify-content-between align-items-center mb-3">
                                {{-- Sorting --}}
                                @isset($sort)
                                    <div class="sort-container font-size-small mt-3 mb-3">
                                        <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                        <div class="d-inline sort-name text-uppercase">

                                            @include('discover.includes.filters.sort-button-default', [
                                                'asc' => 'date',
                                                'desc' => '-date',
                                                'label' => 'Priority Date'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'name',
                                                'desc' => '-name',
                                                'label' => 'Name'
                                            ])

                                        </div>
                                    </div>
                                @endisset

                                <div class="switch-view mt-2 mb-3 my-md-0">
                                    <div class="btn-group" role="group" aria-label="Switch Patent view">
                                        <a href="{{ route('discover.patents') }}" class="btn btn-primary" title="List View" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-list-ul fa-lg"></i>
                                        </a>
                                        <a href="{{ route('discover.patents.tracker') }}" class="btn btn-outline-primary" title="Tracker" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-stream fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Filters --}}
                            <?php if (isset($filters_focus) && $filters_focus) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <span class="mr-3">
                                    <i class="fad fa-flask text-secondarydark"></i>
                                    @foreach ($filters_focus as $focus)
                                        {{ $focus }}
                                        @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                    @endforeach
                                </span>

                            </div>
                            <?php endif; ?>

                            {{-- Patents --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($patents as $patent)
                                    <li class="list-group-item py-4">
                                        <div>
                                            <h2 class="h4">
                                                <a href="{{ $patent->url }}" target="_blank" rel="noopener noreferrer">{{ $patent->name }}</a>
                                            </h2>
                                            <div class="lead mb-2">
                                                {{ $patent->summary }}
                                            </div>
                                            @if($patent->focus->count() > 0)
                                                <p class="text-secondarydark mb-2">
                                                    <i class="fad fa-flask"></i>
                                                    @foreach ($patent->focus as $item)
                                                        {{ $item->name }}@if (!$loop->last) / @endif
                                                    @endforeach
                                                </p>
                                            @endif
                                            @if($patent->companies->count() > 0)
                                                <p class="text-info mb-2">
                                                    <i class="fad fa-building"></i>
                                                    @foreach ($patent->companies as $item)
                                                        <a href="{{ route('discover.organizations.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                                                        @if (!$loop->last) / @endif
                                                    @endforeach
                                                </p>
                                            @endif
                                            @if($patent->people->count() > 0)
                                                <p class="text-info mb-2">
                                                    <i class="fad fa-user"></i>
                                                    @foreach ($patent->people as $item)
                                                        <a href="{{ route('discover.people.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                                                        @if (!$loop->last) / @endif
                                                    @endforeach
                                                </p>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-wrap text-muted">
                                            <div class="mr-5">
                                                <strong class="d-block">Priority Date</strong>
                                                {{ Carbon\Carbon::parse($patent->priority_date)->format('M d, Y') }}
                                            </div>
                                            @if($patent->granted_date != '')
                                                <div class="mr-5">
                                                    <strong class="d-block">Granted Date</strong>
                                                    {{ Carbon\Carbon::parse($patent->granted_date)->format('M d, Y') }}
                                                </div>
                                            @endif
                                            @if($patent->expiration_date != '')
                                                <div class="mr-5">
                                                    <strong class="d-block">Expiration Date</strong>
                                                    {{ Carbon\Carbon::parse($patent->expiration_date)->format('M d, Y') }}
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item py-4">
                                        <p class="lead mb-0">
                                            No patents match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $patents->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>
    @include('discover.includes.limited-access-modal')
@endsection
