@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">

        <div class="row">

            <main id="content-main" role="main" class="col-lg-8 mx-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="card mt-3 text-center shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Are we missing something?</h1>
                                <p class="lead-smaller text-center">
                                    Neuly is the most in depth database for the psychedelics industry, but we’re always looking for ways to improve. 
                                </p>
                                <p class="font-size-large text-center">
                                    Please fill out the following form if you’d like to add or edit an organization, people, event, job, or other data set. 
                                </p>
                                <a href="{{ route('listing.request') }}" class="btn btn-dark btn-lg">Request Listing</a>
                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')

            </main>

        </div>

    </div>
@endsection
