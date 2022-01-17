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
                        'Courses' => false
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
                                <h1 class="mb-0 mr-5">Courses</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $courses->total() }} Courses
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
                                            'asc' => 'price',
                                            'desc' => '-price',
                                            'label' => 'Price'
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
                                @forelse($courses as $course)
                                    <div class="col-12 col-md-6 col-xl-4 mb-5">
                                        <div class="card shadow-sm h-100 p-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <h2 class="h4 mb-2">
                                                    <a href="{{ $course->url }}" target="_blank" rel="noopener noreferrer">
                                                        {{ $course->name }}
                                                    </a>
                                                </h2>
                                                @if ($course->education_credits != '')
                                                    <p class="lead mb-2">
                                                        <span class="badge badge-info">
                                                            {{ $course->education_credits }}
                                                        </span>
                                                    </p>
                                                @endif
                                                @if($course->companies->count() > 0)
                                                    <p class="lead text-muted mb-2">
                                                        @foreach ($course->companies as $item)
                                                            {{ $item->name }}@if (!$loop->last) / @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                                @if($course->focus->count() > 0)
                                                    <p class="mb-2 text-secondarydark">
                                                        <i class="fad fa-flask"></i>
                                                        @foreach ($course->focus as $item)
                                                            {{ $item->name }}@if (!$loop->last) / @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                                <div class="course-summary mb-2">
                                                    {!! $course->formattedSummary !!}
                                                </div>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col-12 col-md-4 text-muted mb-0 mt-3 text-left text-nowrap">
                                                    {{ $course->type }}
                                                </div>
                                                <div class="col-12 col-md-4 text-muted mb-0 mt-3 text-center text-nowrap">
                                                    {{ $course->schedule }}
                                                </div>
                                                <div class="col-12 col-md-4 text-muted mb-0 mt-3 text-right text-nowrap">
                                                    {{ $course->formattedCost }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 card shadow-sm h-100 p-4">
                                        <p class="lead mb-0">
                                            No courses match your search criteria.
                                        </p>
                                    </div>
                                @endforelse
                            </div>

                            {{ $courses->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
