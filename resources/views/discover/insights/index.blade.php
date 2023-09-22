@extends('layouts.app')

@section('body-class', 'page-insights')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid text-center py-5">
        @include('discover.includes.status-messages')

        <h1 class="text-primary">Psychedelic Insights, by Neuly.</h1>

        <div class="max-width-780 mx-auto mb-4 fs-5">
            Neuly provides proprietary insights that are created from cross referencing our deep database of psychedelics industry information.
        </div>

        <div class="mb-5">
            <a href="{{ route('discover.insights.request') }}" class="btn btn-primary btn-lg">Request Insight</a>
        </div>

        <div class="container-fluid pe-4">
            <div class="row insights-grid" style="opacity: 0">
{{--            @auth--}}
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    <div class="card card-body shadow-sm mb-4">--}}
{{--                        <h2 class="text-center">Clinical Trial Tracker</h2>--}}
{{--                        <a href="{{ route('insights.clinicaltrials.pipeline') }}">--}}
{{--                            <img src="{{ asset('images/clinical-trial-tracker.jpg') }}" alt="View Neuly's Clinical Trial Tracker" style="width: 100%;height: auto">--}}
{{--                        </a>--}}
{{--                        <p class="mb-0 mt-2 text-center">--}}
{{--                            <a href="{{ route('insights.clinicaltrials.pipeline') }}" class="btn btn-sm btn-dark">View Tracker</a>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endauth--}}

            <div class="col-12 col-lg-6 col-xl-4">
                @include('discover.insights.widgets.investment-funds')
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
                @include('discover.insights.widgets.nonprofits-by-focus-chart')
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
                @include('discover.insights.widgets.educational-organizations')
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
                @include('discover.insights.widgets.organizations-by-type')
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                @include('discover.insights.widgets.companies-by-focus-drug')
            </div>
{{--            <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                @include('discover.insights.widgets.top-ten-locations')--}}
{{--            </div>--}}

            @auth
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.jobs-total-by-focus')
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.jobs-total-by-type')
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.organistaions-by-type-involved-clinical-trials')
                </div>
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    @include('discover.insights.collaborators.list')--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    @include('discover.insights.most-interest.list')--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    @include('discover.insights.research-authors.widget')--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    @include('discover.insights.research-organizations.widget')--}}
{{--                </div>--}}
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.research-by-focus')
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.companies-by-focus-industry')
                </div>
{{--                <div class="col-12 col-lg-6 col-xl-4">--}}
{{--                    @include('discover.insights.widgets.location-top-by-jobs')--}}
{{--                </div>--}}
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.clinical-trial-historic')
                </div>
            @endauth

            @guest
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card card-body shadow-sm mb-4 text-center bg-tertiary p-5">
                        <h1 class="text-primary">Neuly Insights</h1>
                        <p class="lead mb-4">Register for your free account to get access to all Neuly Insights.</p>
                        <p class="mb-1">
                            <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>
                        </p>
                    </div>
                </div>
            @endguest
        </div>
        </div>

    </div>

    @include('footers.full')
@endsection

@section('head')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/chartisan.js') }}"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/jquery-jvectormap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery-jvectormap.css') }}"/>
    <script type="text/javascript" src="{{ mix('js/insights.js') }}"></script>
@endsection
