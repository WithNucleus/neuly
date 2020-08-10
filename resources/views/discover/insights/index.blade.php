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
                    {{-- Organizations by Type --}}
                    @include('content.homepage.organization-type-chart')
                </div>
                <div class="col-12 col-lg-4">
                    {{-- Organization Focus Chart --}}
                    @include('content.homepage.organization-focus-chart')
                </div>
                <div class="col-12 col-lg-4">
                    {{-- Top 10 Locations --}}
                    @include('content.homepage.top-locations')
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12 col-lg-8 col-xl-6 mx-auto">
                    <p class="lead-smaller text-center">
                        Join Neuly today because members get early access to Insights when available. Plus you'll get other cool stuff, like our entire database and a Neuly dashboard to save bookmarks, notes, and get alerts on your favorite topics.
                        Neuly members get early access to Insights when ready, so <a href="/register">join us today</a>.
                    </p>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">

                    <h1>Insights, by Neuly.</h1>

                    <p class="lead">
                        Neuly provides proprietary insights that are created from cross referencing our deep database of psychedelics industry information.
                    </p>

                </div>
            </div> --}}

        </main>
    </div>

    @include('footers.mini')

    <!-- Chartings -->
    <script type="text/javascript" src="{{ asset('assets/chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/chartisan.js') }}"></script>

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

        // Global Chart Settings
        Chart.defaults.global.defaultFontColor = '#111';
        Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

        var ctx = document.getElementById('chartCompanyType');
        let chartCompanyType = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php echo $company_type_chart['labels']; ?>],
                datasets: [{
                    // label: '# of Votes',
                    data: [{{ $company_type_chart['counts'] }}],
                    backgroundColor: [
                        '#A7ABDD',
                        '#6bbca4',
                        '#275DAD',
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: false,
                    }],
                    yAxes: [{
                        display: false,

                    }],
                },
                legend: {
                    position: 'bottom'
                }
            }
        });

    </script>

@endsection