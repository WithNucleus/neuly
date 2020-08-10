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
                    
                @include('discover.includes.breadcrumbs.member-dashboard')                

            </div>
        </div>
    </div>

    <div class="container">
        <main id="show-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">

                    <h1 class="page-title-default text-primary">Your Neuly Dashboard</h1>

                    <p class="lead mt-4">Register for your free account to get access to your Neuly dashboard.</p>

                    <div class="row mt-4">
                        <div class="col-4 text-center">
                            <p class="mb-2"><i class="fad fa-bookmark fa-3x text-info"></i></p>
                            <h2 class="h4 mb-0">Bookmarks</h2>
                            <p class="mb-0">
                                Save everything from organizations to people to clinical trials, so you can stay organized.
                            </p>
                        </div>
                        <div class="col-4 text-center">
                            <p class="mb-2"><i class="fad fa-file-edit fa-3x text-secondary"></i></p>
                            <h2 class="h4 mb-0">Notes</h2>
                            <p class="mb-0">
                                Document your findings, make connections, and keep all your data together in one place.
                            </p>
                        </div>

                        <div class="col-4 text-center">
                            <p class="mb-2"><i class="fad fa-bells fa-3x text-danger"></i></p>
                            <h2 class="h4 mb-0">Alerts</h2>
                            <p class="mb-0">
                                Follow the things you're interested in, and be the first to know about latest news and events.
                            </p>
                        </div>
                    </div>

                    <p class="mt-4 text-center">
                        <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>
                    </p>

                </div>
            </div>

        </main>
    </div>

    @include('footers.mini')

@endsection