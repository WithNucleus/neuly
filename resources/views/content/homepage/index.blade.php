@extends('layouts.app')

@section('body-class', 'page-home bg-light')

@section('content')

    @include('navbars.primary')

    <main id="home-main" role="main">

        @include('content.homepage.hero')

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @include('content.homepage.who-is-neuly-for')

        <div class="container-fluid mt-5">
            <div class="home-card-container mx-auto">
                <div class="card-deck-medium-breakpoint">
                    @include('content.homepage.recent-jobs')
                    @include('content.homepage.upcoming-events')
                </div>
            </div>
        </div>

        <div class="home-card-container mx-auto">
            @include('content.homepage.recruiting-clinical-trials')
        </div>

        <div class="container-fluid pt-2">
            <div class="home-card-container mx-auto">
                <div class="row">
                    <div class="col-12 col-md-6">
                        @include('content.homepage.news')
                        @include('discover.insights.widgets.organizations-by-type')

                    </div>

                    <div class="col-12 col-md-6">
                        @include('content.homepage.insights-widget')
                        @include('discover.insights.widgets.companies-by-focus-drug')
                        @include('discover.insights.widgets.top-ten-locations')
                    </div>
                </div>
            </div>
        </div>

        @include('content.homepage.how-neuly-helps')

        @include('footers.full')

    </main>
@endsection
