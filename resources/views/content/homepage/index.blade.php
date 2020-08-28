@extends('layouts.app')

@section('body-class', 'page-home bg-light')

@section('content')

    @include('navbars.primary')

    <main id="home-main" role="main">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="position-relative p-3 p-md-5 text-center home-hero shadow-sm">
            <div class="col-md-10 col-lg-8 mx-auto my-5 text-center">
                <h1 class="hero-title font-weight-normal mt-2 col-lg-8 mx-auto mb-2">Clear data to build the future of psychedelics.</h1>
                <form id="homepage-discover" class="search-form form-inline mx-auto justify-content-center" method="post" action="/search">
                    @csrf
                    <input class="typeahead form-control hero-search-input shadow-sm search-field" name="search" type="search" placeholder="Discover organizations, people, research..." aria-label="Search">
                    <button class="btn hero-search-button ml-2 my-2 my-sm-0 shadow-sm" type="submit">Search</button>
                </form>
                <p class="mt-2" style="font-size: 1.2rem;font-weight: 600">
                    <a href="{{ route('discover.organizations') }}" class="text-dark text-decoration-none border-bottom-dark-heavy {{-- bold-link --}}">Or start exploring...</a>
                </p>
            </div>
        </div>

        <div class="container py-3 mt-5">

            <div class="row mb-3">
                <div class="col">
                    <h2 class="text-center font-normal h1 text-uppercase hero-subtitle text-quaternary">Neuly <em>knows</em> psychedelics</h2>
                </div>
            </div>

            <div class="neuly-knows row d-flex align-items-start justify-content-center flex-wrap flex-column flex-md-row">
                <div class="text-center col-12 col-md">
                    <a href="{{ route('discover.organizations') }}" class="text-decoration-none">
                        <span class="d-block text-primary title mb-0">
                            @isset($count_companies)
                                {{ $count_companies }}
                            @else
                                526
                            @endisset
                        </span>
                        <span class="d-block lead">Organizations</span>
                    </a>
                </div>
                <div class="text-center col-12 col-md">
                    <a href="{{ route('discover.people') }}" class="text-decoration-none">
                        <span class="d-block text-primary title mb-0">
                            @isset($count_people)
                                {{ $count_people }}
                            @else
                                604
                            @endisset
                        </span>
                        <span class="d-block lead">People</span>
                    </a>
                </div>
                <div class="text-center col-12 col-md">
                    <a href="{{ route('discover.investors') }}" class="text-decoration-none">
                        <span class="d-block text-primary title mb-0">
                            @isset($count_investors)
                                {{ $count_investors }}
                            @else
                                42
                            @endisset
                        </span>
                        <span class="d-block lead">Investors</span>
                    </a>
                </div>
                <div class="text-center col-12 col-md">
                    <a href="{{ route('discover.locations') }}" class="text-decoration-none">
                        <span class="d-block text-primary title mb-0">
                            @isset($count_locations)
                                {{ $count_locations }}
                            @else
                                210
                            @endisset
                        </span>
                        <span class="d-block lead">Locations</span>
                    </a>
                </div>
                <div class="text-center col-12 col-md">
                    <a href="{{ route('discover.clinicaltrials') }}" class="text-decoration-none">
                        <span class="d-block text-primary title mb-0">
                            @isset($count_clinicaltrials)
                                {{ $count_clinicaltrials }}
                            @else
                                1268
                            @endisset
                        </span>
                        <span class="d-block lead">Clinical Trials</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-full bg-brains-dark text-white mt-5 p-5">
            <p class="lead-larger text-center mb-0">
                Transparent data and insights, to make better informed decisions.
            </p>
        </div>

        <div class="bg-brains py-5 mb-5 shadow-sm">
            <div class="container mt-4 mb-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="h1 text-tertiary ">Who is Neuly For?</h2>
                        <p class="lead-smaller mb-3 text-light font-normal">
                            Entrepreneurs, investors, researchers, scientists, educators, policy makers, and anyone interested in the psychedelics industry.
                        </p>
                    </div>
                </div>

                <div class="card-deck">
                    <div class="card home-who-is-card">
                        <div class="card-body text-center shadow-sm">
                            <a href="{{ route('discover.people') }}" class="text-dark">
                                <div class="icon-image-people"></div>
                                <p class="lead mb-0">Find an industry professional</p>
                            </a>
                        </div>
                    </div>
                    <div class="card home-who-is-card">
                        <div class="card-body text-center shadow-sm">
                            <a href="{{ route('discover.jobs') }}" class="text-dark">
                                <div class="icon-image-jobs"></div>
                                <p class="lead mb-0">Find a new job</p>
                            </a>
                        </div>
                    </div>
                    <div class="card home-who-is-card">
                        <div class="card-body text-center shadow-sm">
                            <a href="{{ route('discover.organizations') }}" class="text-dark">
                                <div class="icon-image-organizations"></div>
                                <p class="lead mb-0">Find investments</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-2">

            <div class="row">

                {{-- Left Column --}}
                <div class="col-12 col-md-6">
                    
                    {{-- Top 3 Trending News --}}
                    @include('content.homepage.news')

                    {{-- Organizations by Type --}}
                    @include('content.homepage.organization-type-chart')

                    {{-- Most Recent Job Postings --}}
                    @include('content.homepage.recent-jobs')

                </div>

                {{-- Right Column --}}
                <div class="col-12 col-md-6">

                    {{-- Organization Focus Chart --}}
                    @include('content.homepage.organization-focus-chart')
                    
                    {{-- Upcoming Events --}}
                    @include('content.homepage.upcoming-events')

                    {{-- Top 10 Locations --}}
                    @include('content.homepage.top-locations')

                </div>
            </div>

        </div>

        @include('footers.full')

    </main>

<script type="text/javascript" src="{{ asset('assets/chart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/chartisan.js') }}"></script>

<script>

    const chartCompanyFocus = new Chartisan({
        el: '#chartCompanyFocus',
        url: "{{ route('charts.company_focus') }}",
        hooks: new ChartisanHooks()
            .colors(['rgba(63, 69, 49, 1)'])
            .responsive()
            .beginAtZero()
            .legend(false)
            .datasets(['bar']),
    });

    Chart.defaults.global.defaultFontColor = '#111';
    Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

    var ctx = document.getElementById('chartCompanyType');
    let chartCompanyType = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [<?php echo $company_type_chart['labels']; ?>],
            datasets: [{
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
