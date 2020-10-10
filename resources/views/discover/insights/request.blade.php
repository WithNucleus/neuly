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
                        'Request insight' => false,
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

                    <p class="lead">Our data is categorized into these areas: Organizations, People, Investors, etc. and
                        we can combine / correlate / whatever data you can think of that’s helpful / needed.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4 offset-md-4">
                    <form action="{{ route('discover.insights.saveRequest') }}" method="post">
                        @csrf
                        @guest
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Your name" required/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Your email" required/>
                            </div>
                        @endguest
                        <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Describe your request"
                                      rows="8" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')
@endsection
