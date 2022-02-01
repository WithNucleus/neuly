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
                        'Insights' => route('discover.insights'),
                        'Request Insight' => false,
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <main id="show-main" role="main" class="col-12">
            <div class="row mb-3">
                <div class="col text-center">
                    <h1 class="page-title-default text-primary">Request Insight</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-6 mx-auto text-center">
                    <p class="lead">Interested in how certain data types fit together? We can help!</p>
                    <p class="lead">Neuly's data is categorized into these areas:</p>

                    <div class="d-md-flex justify-content-center">
                        <ul class="text-left mr-5">
                            <li>Organizations</li>
                            <li>People</li>
                            <li>Investors</li>
                        </ul>
                        <ul class="text-left mr-5">
                            <li>Research</li>
                            <li>Clinical Trials</li>
                            <li>Locations</li>
                        </ul>
                        <ul class="text-left">
                            <li>Focus</li>
                            <li>Events</li>
                            <li>Jobs</li>
                        </ul>
                    </div>

                    <p>
                        We can combine, correlate, and compare any data set you can think of. <span class="d-md-block">Let us know what's valuable to you, and we'll get it done.</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto">
                    @auth
                        <form action="{{ route('discover.insights.saveRequest') }}" method="post">
                            @csrf
                            <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Describe your request"
                                      rows="8" required></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    @else
                        <p class="lead text-center bg-tertiary p-4 shadow-sm">
                            You must be logged in to request an insight.<br><br>
                            <a href="{{ route('login') }}" class="btn btn-primary">Login to Neuly</a>
                        </p>
                    @endauth
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')
    @include('discover.includes.limited-access-modal')
@endsection
