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

        <div class="container-fluid pt-2">
            <div class="home-card-container mx-auto">
                <div class="row">
                    <div class="col-12 col-md-6">
                        @include('content.homepage.news')
                        @include('discover.insights.widgets.organizations-by-type')
                        @include('content.homepage.recent-jobs')
                    </div>

                    <div class="col-12 col-md-6">
                        @include('discover.insights.widgets.companies-by-focus-drug')
                        @include('content.homepage.upcoming-events')
                        @include('discover.insights.widgets.top-ten-locations')
                    </div>
                </div>
            </div>
        </div>

        @include('footers.full')

    </main>
@endsection
