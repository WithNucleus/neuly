@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>

        <div class="row">
            @include('navbars.tabs-mobile')
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">

                @include('navbars.breadcrumb', [
                    'items' => [
                        'Insights' => false,
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <main id="show-main" role="main" class="col-12">
            @include('discover.includes.status-messages')

            <div class="row mb-3">
                <div class="col text-center">
                    <h1 class="page-title-default text-primary">Coming Soon - Insights, by Neuly.</h1>

                    <p class="lead mb-1">
                        Neuly provides proprietary insights that are created from cross referencing our deep database of psychedelics industry information.
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col text-center">
                    <p><a href="{{ route('discover.insights.request') }}" class="btn btn-primary">Request Insight</a></p>
                </div>
            </div>

            <div class="loading text-center">
                <i class="fas fa-spinner fa-pulse fa-3x text-secondarydark"></i>
            </div>

            <div class="row insights-grid" style="opacity: 0">

                @auth
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div class="card card-body shadow-sm mb-4">
                            <h2 class="text-center">Clinical Trial Tracker</h2>
                            <a href="{{ route('insights.clinicaltrials.pipeline') }}">
                                <img src="{{ asset('images/clinical-trial-tracker.jpg') }}" alt="View Neuly's Clinical Trial Tracker" style="width: 100%;height: auto">
                            </a>
                            <p class="mb-0 mt-2 text-center">
                                <a href="{{ route('insights.clinicaltrials.pipeline') }}" class="btn btn-sm btn-dark">View Tracker</a>
                            </p>
                        </div>
                    </div>
                @endauth

                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.organizations-by-type')
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.companies-by-focus-drug')
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    @include('discover.insights.widgets.top-ten-locations')
                </div>

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
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.collaborators.list')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.most-interest.list')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.research-authors.widget')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.research-organizations.widget')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.widgets.research-by-focus')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.widgets.companies-by-focus-industry')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('discover.insights.widgets.location-top-by-jobs')
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

{{--            @guest--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">--}}
{{--                    <h1 class="page-title-default text-primary">Neuly Insights</h1>--}}
{{--                    <p class="lead mt-4">Register for your free account to get access to all Neuly Insights.</p>--}}
{{--                    <p class="mt-4 text-center">--}}
{{--                        <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endguest--}}

        </main>
    </div>

    @include('footers.mini')
@endsection
