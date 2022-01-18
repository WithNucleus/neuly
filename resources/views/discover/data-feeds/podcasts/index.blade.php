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
                        'Podcasts' => false
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
                                <h1 class="mb-0 mr-5">Podcasts</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $podcasts->total() }} Podcasts
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button-default-asc', [
                                            'asc' => 'name',
                                            'desc' => '-name',
                                            'label' => 'Name'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'episodes',
                                            'desc' => '-episodes',
                                            'label' => 'Number of Episodes'
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

                            {{-- Podcasts --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($podcasts as $podcast)
                                    <li class="list-group-item py-4">
                                        <h3 class="h4">
                                            <a href="{{ route('discover.podcasts.show', $podcast->slug) }}">{{ $podcast->name }}</a>
                                        </h3>
                                        <div class="lead text-muted my-1">
                                            <i class="fad fa-podcast"></i> {{ $podcast->media_items_count }} episodes
                                            <span class="mx-2">&bull;</span>
                                            @foreach ($podcast->mediaItems as $episode)
                                                @if ($loop->first)
                                                    <i class="fad fa-calendar"></i> {{ \Carbon\Carbon::parse($episode->date)->diffForHumans() }}
                                                @endif
                                            @endforeach
                                        </div>
                                        <span class="d-block">
                                            {{ $podcast->summary }}
                                        </span>
                                    </li>

                                @empty
                                    <li class="list-group-item py-4">
                                        <p class="lead mb-0">
                                            No podcasts match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $podcasts->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
