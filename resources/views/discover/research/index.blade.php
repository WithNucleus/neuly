@extends('layouts.app')

@section('body-class', 'page-researchs bg-light')

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
                        'Research' => false
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

                            <div class="page-title-default d-md-flex justify-content-between mb-3">
                                <h1 class="mb-0 mr-5">Research</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $research_items->total() }} Research Articles
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
                                            'label' => 'Date Added'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'title',
                                            'desc' => '-title',
                                            'label' => 'Title'
                                        ])

                                    </div>
                                </div>
                            @endisset


                            @include('includes.filters.active-list')

                            {{-- Research Records --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($research_items as $research)
                                    <li class="list-group-item py-4">

                                        <div class="row">
                                            <div class="col-12 col-md-7">
                                                <p class="lead-smaller mb-2">
                                                   <a href="{{ route('discover.research.show', $research->slug) }}">{{ $research->name }}</a>
                                                </p>

                                                @if ($research->publication_info != '')
                                                    <p class="mb-2 text-success">
                                                        {{ $research->publication_info }}
                                                    </p>
                                                @endif

                                                @if($research->focus->count() > 0)
                                                    <p class="mb-2">
                                                        <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                                        @foreach($research->focus as $item)
                                                            {{ $item->name }}@if (!$loop->last),@endif
                                                        @endforeach
                                                    </p>
                                                @endif

                                                <p class="mb-0 font-size-small">
                                                    Added {{ \Carbon\Carbon::parse($research->created_at)->diffForHumans() }}
                                                </p>

                                            </div>
                                            <div class="col-12 col-md-5">

                                                @if($research->publish_date != '')
                                                <p class="mb-2">
                                                    <span class="text-info"><i class="fad fa-calendar-alt"></i></span>
                                                    <strong>Published </strong>{{ \Carbon\Carbon::parse($research->publish_date)->format('F Y') }}
                                                </p>
                                                @endif

                                                @if($research->people->count() > 0)
                                                    <p class="mb-2">
                                                        <span class="text-quaternary"><i class="fad fa-user"></i></span>
                                                        @foreach($research->people as $person)
                                                            {{ $person->name }}@if (!$loop->last),@endif
                                                        @endforeach
                                                    </p>
                                                @endif

                                                @isset($research->resources)
                                                    <?php
                                                    $resources = json_decode($research->resources);
                                                    ?>
                                                    <p class="mb-0 font-large d-inline-flex align-items-center">
                                                        @foreach ($resources as $resource)
                                                            <span class="mr-3 text-quaternary">
                                                                @isset($resource->file_format)
                                                                    @if($resource->file_format == 'PDF')
                                                                        <i class="fad fa-file-pdf fa-lg text-quaternary mr-1"></i>
                                                                    @elseif($resource->file_format == 'HTML')
                                                                        <i class="fad fa-link fa-lg text-quaternary mr-1"></i>
                                                                    @else
                                                                        [{{ $resource->file_format }}]
                                                                    @endif
                                                                @endisset
                                                                {{ $resource->title }}
                                                            </span>
                                                        @endforeach
                                                    </p>
                                                @endisset
                                            </div>
                                        </div>
                                    </li>

                                @empty
                                    <li class="list-group-item">
                                        <p class="lead mb-0">
                                            No research articles match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $research_items->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

    <script>
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){

            $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-down").addClass("fa-arrow-square-up");
            $(this).prev(".toggle-more").find("span").html("Show Less");

        }).on('hide.bs.collapse', function(){

            $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-up").addClass("fa-arrow-square-down");
            $(this).prev(".toggle-more").find("span").html("Show More");

        });
    </script>

    @include('discover.includes.limited-access-modal')
@endsection
