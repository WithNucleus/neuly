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

                    <p class="lead mt-4 col-xl-9 mx-auto">Register for your free membership to access the entire database, view unique insights, and utilize your personal dashboard</p>

                    <p class="mt-4 text-center">
                        <a href="{{ route('register') }}" class="btn btn-lg btn-primary text-uppercase">Register</a> or <a href="{{ route('login') }}" class="btn btn-lg btn-primary text-uppercase">Login</a>
                    </p>

                    <p class="mt-4 text-center">
                        Neuly is a free resource to push forward our understanding of psychedelics.
                    </p>

                </div>
            </div>

        </main>
    </div>

    @include('footers.mini')

@endsection
