@extends('layouts.app')

@section('body-class', 'page-search bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
                @include('navbars.tabs-mobile')
            </div>
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Searching
                        </li>
                        <li class="breadcrumb-item">
                            @if ($term == '')
                                Everything
                            @else
                                "{{ $term }}"
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <main id="index-main" role="main" class="mt-2 mt-lg-5 col-lg-9 col-xl-8 mx-auto">
        <div class="row">
            <div class="col-12">
                @if ($term == '')
                    <h1>Discover {{ config('app.name', 'Neuly') }}</h1>
                @else
                    <h1>You are searching for "{{ $term }}"</h1>
                @endif
            </div>
        </div>

        @if(count($exactResults) > 0)
            <h2 class="h4">Exact match results:</h2>
            @include('search.includes.results-list', ['items' => $exactResults])
        @endif

        @if(count($results) > 0)
            <h2 class="h4">All results:</h2>
            @include('search.includes.results-list', ['items' => $results])
        @endif

        @if($exactResults === [] && $results === [])
            No results matched your search criteria.
        @endif

        @include('footers.mini')
    </main>

@endsection
