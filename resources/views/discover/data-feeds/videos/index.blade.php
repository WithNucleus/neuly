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
                        'Videos' => false
                    ]
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">

            <main id="index-main" role="main" class="mx-auto">
                @include('discover.includes.status-messages')

                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between mb-4">
                                <h1 class="mb-0 mr-5">Videos</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $videos->total() }} Videos
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

                            <div class="row">
                                @forelse($videos as $video)
                                    <div class="col-12 col-xl-6 mb-5">
                                        <div class="card shadow-sm h-100 p-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="video-content mb-2">
                                                    {!! $video->content !!}
                                                </div>
                                                <h2 class="h4 mt-3">
                                                    {{ $video->name }}
                                                </h2>
                                                @if($video->focus->count() > 0)
                                                    <p class="mb-2 text-secondarydark">
                                                        <i class="fad fa-flask"></i>
                                                        @foreach ($video->focus as $item)
                                                            {{ $item->name }}@if (!$loop->last) / @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                                @if($video->summary != '')
                                                    <div class="mb-2">
                                                        {{ $video->summary }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-muted">
                                                <span>
                                                    {{ Carbon\Carbon::parse($video->date)->diffForHumans() }}
                                                </span>
                                                @if($video->source)
                                                    <span class="mx-1">&bull;</span>
                                                    <a href="{{ $video->url }}" target="_blank" rel="noopener noreferrer">
                                                        {{ $video->source->name }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 card shadow-sm h-100 p-4">
                                        <p class="lead mb-0">
                                            No videos match your search criteria.
                                        </p>
                                    </div>
                                @endforelse
                            </div>

                            {{ $videos->links() }}
                        </div>
                    </div>
                </div>

                @include('discover.includes.discover-footer-content')

            </main>
        </div>
    </div>

    @include('sidebars.filters.scripts')

    <style>
        .video-content {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .video-content iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

@endsection
