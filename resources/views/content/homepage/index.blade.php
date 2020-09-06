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
                <p class="mt-2" style="font-size: 1.5rem;font-weight: 600">
                    <a href="{{ route('discover.organizations') }}" class="text-dark text-decoration-none border-bottom-dark-heavy {{-- bold-link --}}">Or start exploring our database...</a>
                </p>
            </div>
        </div>

        <div class="container py-3 mt-5 mb-5">

            <div class="row mb-3">
                <div class="col text-center">
                    <h2 class="font-normal h1 text-uppercase hero-subtitle">Neuly <em>knows</em> psychedelics</h2>
                    <p class="lead-larger">Transparent data and insights, to make better informed decisions.</p>
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

        {{-- <div class="container-full bg-brains-dark text-white mt-5 p-5">
            <p class="lead-larger text-center mb-0">
                Transparent data and insights, to make better informed decisions.
            </p>
        </div> --}}

        <div class="bg-dark bg-brains py-5 mb-5 shadow-sm">
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
                                <div class="icon-image-people">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title/><g id="icon"><path d="M32,15a9.01,9.01,0,0,0-9,9v2a1,1,0,0,0,1,1H40a1,1,0,0,0,1-1V24A9.01,9.01,0,0,0,32,15Z"/><circle cx="32" cy="9" r="5"/><path d="M51,48a9.01,9.01,0,0,0-9,9v2a1,1,0,0,0,1,1H59a1,1,0,0,0,1-1V57A9.01,9.01,0,0,0,51,48Z"/><circle cx="51" cy="42" r="5"/><path d="M13,48a9.01,9.01,0,0,0-9,9v2a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V57A9.01,9.01,0,0,0,13,48Z"/><circle cx="13" cy="42" r="5"/><path d="M33,39.5005V32a1,1,0,0,0-2,0v7.5005l-7.6,5.7A1,1,0,1,0,24.6,46.8L32,41.25l7.4,5.55A1,1,0,1,0,40.6,45.2Z"/></g></svg>
                                </div>
                                <p class="lead mb-0">Find an industry professional</p>
                            </a>
                        </div>
                    </div>
                    <div class="card home-who-is-card">
                        <div class="card-body text-center shadow-sm">
                            <a href="{{ route('discover.jobs') }}" class="text-dark">
                                <div class="icon-image-jobs">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title/><g id="icon"><path d="M57,20H7a5.0018,5.0018,0,0,0-5,5v4A10.0294,10.0294,0,0,0,12,39H25V36a1.0029,1.0029,0,0,1,1-1h2V32a1.0029,1.0029,0,0,1,1-1h6a1.0029,1.0029,0,0,1,1,1v3h2a1.0029,1.0029,0,0,1,1,1v3H52A10.0294,10.0294,0,0,0,62,29V25A5.0018,5.0018,0,0,0,57,20Z"/><path d="M39,5a1,1,0,0,0-1-1H26a1,1,0,0,0-1,1v9H39Z"/><polygon points="23 15.42 23 6.58 11.58 18 20.42 18 23 15.42"/><polygon points="52.42 18 41 6.58 41 15.42 43.58 18 52.42 18"/><path d="M34,45H30a2,2,0,0,0,4,0Z"/><path d="M27,43H37V37H27Z"/><rect height="2" width="4" x="30" y="33"/><path d="M3,51a8.2619,8.2619,0,0,0-1,.06V55a5.0018,5.0018,0,0,0,5,5h3.94A8.2619,8.2619,0,0,0,11,59,8.0106,8.0106,0,0,0,3,51Z"/><path d="M28,45H26a1.0029,1.0029,0,0,1-1-1V41H12A11.9921,11.9921,0,0,1,2,35.62V49.05c.33-.03.66-.05,1-.05A10.0165,10.0165,0,0,1,13,59c0,.34-.02.67-.05,1H31V48.86A4,4,0,0,1,28,45Z"/><path d="M52,41H39v3a1.0029,1.0029,0,0,1-1,1H36a4,4,0,0,1-3,3.86V60H51.05c-.03-.33-.05-.66-.05-1A10.0165,10.0165,0,0,1,61,49c.34,0,.67.02,1,.05V35.62A11.9921,11.9921,0,0,1,52,41Z"/><path d="M53,59a8.2619,8.2619,0,0,0,.06,1H57a5.0018,5.0018,0,0,0,5-5V51.06A8.2619,8.2619,0,0,0,61,51,8.0106,8.0106,0,0,0,53,59Z"/></g></svg>
                                </div>
                                <p class="lead mb-0">Find a new job</p>
                            </a>
                        </div>
                    </div>
                    <div class="card home-who-is-card">
                        <div class="card-body text-center shadow-sm">
                            <a href="{{ route('discover.organizations') }}" class="text-dark">
                                <div class="icon-image-organizations">
                                    <svg viewBox="0 0 88 88" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="Plant Growth" id="icon"><path d="M46,20v-.5586a.9982.9982,0,0,0-.6836-.9487L45,18.3873V21A1.0009,1.0009,0,0,0,46,20Z"/><path d="M42,14v.5586a.9986.9986,0,0,0,.6841.9487L43,15.6126V13A1.0013,1.0013,0,0,0,42,14Z"/><path d="M54,17A10,10,0,1,0,44,27,10.0114,10.0114,0,0,0,54,17ZM43,24V23a3.0033,3.0033,0,0,1-3-3,1,1,0,0,1,2,0,1.0013,1.0013,0,0,0,1,1V17.7208l-.9482-.316A2.9965,2.9965,0,0,1,40,14.5586V14a3.0033,3.0033,0,0,1,3-3V10a1,1,0,0,1,2,0v1a3.0033,3.0033,0,0,1,3,3,1,1,0,0,1-2,0,1.0009,1.0009,0,0,0-1-1v3.2789l.9492.3163A2.9973,2.9973,0,0,1,48,19.4414V20a3.0033,3.0033,0,0,1-3,3v1a1,1,0,0,1-2,0Z"/><path d="M77.51,33.15a.9918.9918,0,0,0-1.25.18c-.11.12-2.88,2.99-10.08,1.69C55.2092,33.0236,50.55,45.539,49.941,47.3422A25.0424,25.0424,0,0,0,45,52.8953V32.9493a16,16,0,1,0-2,0v15.946a25.0424,25.0424,0,0,0-4.941-5.5531C37.45,41.539,32.7908,29.0236,21.82,31.02c-7.2,1.3-9.97-1.57-10.08-1.69a.9988.9988,0,0,0-1.68,1C10.27,30.93,15.31,45,23,45a50.5982,50.5982,0,0,0,7.1-.58c1.06-.14,2.02-.27,2.88-.32C29.97,42.2,26.96,41,25,41a1,1,0,0,1,0-2,7.8485,7.8485,0,0,1,.9355.0809C31.6,39.9452,43,47.9529,43,55v6H27a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1H61a1,1,0,0,0,1-1V62a1,1,0,0,0-1-1H45V59c0-7.0471,11.4-15.0548,17.0645-15.9191A7.8485,7.8485,0,0,1,63,43a1,1,0,0,1,0,2c-1.96,0-4.97,1.2-7.98,3.1.86.05,1.82.18,2.88.32A50.5982,50.5982,0,0,0,65,49c7.69,0,12.73-14.07,12.94-14.67A.9837.9837,0,0,0,77.51,33.15ZM32,17A12,12,0,1,1,44,29,12.0137,12.0137,0,0,1,32,17Z"/><path d="M33.62,86.25a.9968.9968,0,0,0,.97.75H53.41a.9968.9968,0,0,0,.97-.75L58.27,71H29.73Z"/></g></svg>
                                </div>
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
