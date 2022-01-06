@extends('layouts.app')

@section('body-class', 'page-companies bg-light')

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
                        'Organizations' => false
                    ]
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">
            <nav id="sidebar-nav" class="col-lg-3 col-xl-2 bg-light sidebar">
                <div class="title clearfix">
                    <div class="h3 border-bottom pb-2 filter-title">
                        Filters
                        <span id="reset"></span>
                    </div>
                </div>
                <div class="sidebar-sticky collapse">
                    <div id="searchbox" class="mb-3"></div>
                    <div id="events"></div>
                    <div id="jobs" class="mb-3"></div>
                    <div class="h4">Type:</div>
                    <div id="type" class="mb-3"></div>
                    <div class="h4">Locations:</div>
                    <div id="countries" class="mb-3"></div>
                    <div id="locations" class="mb-3"></div>
                    <div class="h4">Focus:</div>
                    <div id="focus"></div>
                </div>
            </nav>
            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between">
                                <h1 class="mb-0 mr-5">Organizations</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing <span id="stats"></span> Organizations
                                </span>
                            </div>

                            {{-- Companies --}}
                            <div id="sort-by"></div>
                            <div id="hits"></div>
                            <div id="pagination"></div>

                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>
    <script>
        const searchClient = algoliasearch('2WZKZJIBUG', '686437b222f70e8cdbbba3899ea1f93d');

        const search = instantsearch({
            indexName: 'companies',
            searchClient,
        });

        const renderStats = (renderOptions, isFirstRender) => {
            const { nbHits } = renderOptions;

            document.querySelector('#stats').innerHTML = nbHits;
        };

        const customStats = instantsearch.connectors.connectStats(
            renderStats
        );

        search.addWidgets([
            instantsearch.widgets.configure({
                hitsPerPage: 12,
            }),
            instantsearch.widgets.searchBox({
                container: '#searchbox',
                templates: {
                    submit: '<i class="fad fa-search fa-lg"></i>',
                },
            }),
            instantsearch.widgets.clearRefinements({
                container: '#reset',

            }),

            instantsearch.widgets.hits({
                container: '#hits',
                cssClasses: {
                  list: ['d-flex', 'flex-wrap'],
                  item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5'],
                },
                templates: {
                    item: `
                    <div class="card shadow-sm">
                        <div class="pt-4 text-center">
                            <a href="https://neuly.com/organization/@{{ slug }}" class="text-decoration-none">
                                <div class="logo-is-contained" style="background-image: url('@{{ logo }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="@{{ name }}"></div>
                            </a>
                            <p class="my-3 lead">
                                <a href="https://neuly.com/organization/@{{ slug }}" class="text-decoration-none">@{{ name }}</a>
                            </p>
                            <ul class="list-group list-group-flush text-left border-top">
                                <li class="list-group-item">
                                    <i class="fad fa-building text-quaternary"></i> @{{ ownership }}
                                </li>
                                <li class="list-group-item">
                                    <span class="truncate-this">
                                        <span class="text-secondarydark"><i class="fad fa-flask"></i></span> @{{#focus}}@{{.}}<span class="spacer"> • </span>@{{/focus}}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span class="truncate-this">
                                        <span class="text-info"><i class="fad fa-globe-stand"></i></span> @{{ locations.0.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    `,
                },
            }),

            customStats(),

            instantsearch.widgets.refinementList({
                container: '#type',
                attribute: 'ownership'
            }),

            instantsearch.widgets.refinementList({
                container: '#focus',
                attribute: 'focus',
                showMore: true,
            }),

            instantsearch.widgets.refinementList({
                container: '#countries',
                attribute: 'locations.country',
                showMore: false,
                searchable: true,
                searchablePlaceholder: 'e.g. United States',
                templates: {
                    searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
                },
            }),

            instantsearch.widgets.refinementList({
                container: '#locations',
                attribute: 'locations.name',
                showMore: false,
                searchable: true,
                searchablePlaceholder: 'e.g. New York',
                templates: {
                    searchableSubmit: '<i class="fad fa-search fa-lg"></i>',
                },
            }),

            instantsearch.widgets.toggleRefinement({
                container: '#events',
                attribute: 'events',
                templates: {
                    labelText: 'Upcoming Events',
                },
            }),

            instantsearch.widgets.toggleRefinement({
                container: '#jobs',
                attribute: 'jobs',
                templates: {
                    labelText: 'Now Hiring',
                },
            }),

            instantsearch.widgets.pagination({
                container: '#pagination',
                cssClasses: {
                    list: ['pagination'],
                    item: ['page-item'],
                    selectedItem: ['active'],
                    disabledItem: ['disabled'],
                    link: ['page-link'],
                },
            }),
        ]);

        search.start();
    </script>
@endsection
