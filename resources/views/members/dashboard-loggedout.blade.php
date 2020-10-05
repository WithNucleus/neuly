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

                    <h1 class="page-title-default text-primary">Welcome to Neuly’s interactive database!</h1>

                    <p class="lead mt-4 col-xl-9 mx-auto">Become a member for free to access the entire database, view unique insights, and utilize your personal dashboard. </p>

                    <p class="mt-4 text-center">
                        <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>
                    </p>

                </div>
            </div>

        </main>
    </div>

    @include('footers.mini')

@endsection
