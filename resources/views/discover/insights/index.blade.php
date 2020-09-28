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
            <div class="row mb-3">
                <div class="col text-center">
                    <h1 class="page-title-default text-primary">Coming Soon - Insights, by Neuly.</h1>

                    <p class="lead">
                        Neuly provides proprietary insights that are created from cross referencing our deep database of psychedelics industry information.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4">
                    @include('discover.insights.widgets.organizations-by-type')
                </div>
                <div class="col-12 col-lg-4">
                    @include('content.homepage.organization-focus-chart')
                </div>
                <div class="col-12 col-lg-4">
                    @include('discover.insights.widgets.top-ten-locations')
                </div>

                @auth
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.widgets.jobs-total-by-focus')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.widgets.jobs-total-by-type')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.widgets.organistaions-by-type-involved-clinical-trials')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.collaborators.list')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.most-interest.list')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.research-authors.widget')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.research-organizations.widget')
                    </div>
                    <div class="col-12 col-lg-4">
                        @include('discover.insights.widgets.research-by-focus')
                    </div>
                @endauth
            </div>

            @guest
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">
                    <h1 class="page-title-default text-primary">Neuly Insights</h1>
                    <p class="lead mt-4">Register for your free account to get access to all Neuly Insights.</p>
                    <p class="mt-4 text-center">
                        <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>
                    </p>
                </div>
            </div>
            @endguest

            {{--
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-6 mx-auto">
                    <p class="lead-smaller text-center">
                        Join Neuly today because members get early access to Insights when available. Plus you'll get other cool stuff, like our entire database and a Neuly dashboard to save bookmarks, notes, and get alerts on your favorite topics.
                        Neuly members get early access to Insights when ready, so <a href="{{ route('register') }}">join us today</a>.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">

                    <h1>Insights, by Neuly.</h1>

                    <p class="lead">
                        Neuly provides proprietary insights that are created from cross referencing our deep database of psychedelics industry information.
                    </p>

                </div>
            </div>
            --}}

        </main>
    </div>

    @include('footers.mini')

    <script>

        // Company Focus Chart
        const chartCompanyFocus = new Chartisan({
            el: '#chartCompanyFocus',
            url: "{{ route('charts.company_focus') }}",
            hooks: new ChartisanHooks()
                // .colors(['#D81E5B'])
                .colors(['rgba(63, 69, 49, 1)'])
                .responsive()
                .beginAtZero()
                .legend(false)
                .datasets(['bar']),
        });
    </script>

@endsection
