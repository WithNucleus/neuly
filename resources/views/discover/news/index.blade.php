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
                        'News' => false
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
                                <h1 class="mb-0 mr-5">News Articles</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $newsArticles->total() }} News Articles
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

                                    </div>
                                </div>
                            @endisset

                            @include('includes.filters.active-list')

                            {{-- News Articles --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($newsArticles as $newsArticle)
                                    <li class="list-group-item py-4">
                                        <p class="lead mb-0">
                                            <a href="{{ $newsArticle->url }}" target="_blank" rel="noopener noreferrer" title="{{ $newsArticle->name }}">{{ $newsArticle->name }}</a>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-muted"><i class="fad fa-calendar"></i></span>
                                            <strong>{{ \Carbon\Carbon::parse($newsArticle->date)->format('M d, Y') }}</strong>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-success"><i class="fad fa-at"></i></span>
                                            {{ $newsArticle->publisher }}
                                        </p>
                                        @if ($newsArticle->focus->count() > 0)
                                            <p class="mb-0">
                                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                                @foreach($newsArticle->focus as $item)
                                                    {{ $item->name }}@if (!$loop->last),@endif
                                                @endforeach
                                            </p>
                                        @endif
                                    </li>

                                @empty
                                    <li class="list-group-item py-4">
                                        <p class="lead mb-0">
                                            No news articles match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $newsArticles->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
