@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">

        <div class="row">

            <main id="content-main" role="main" class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="col-12">
                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Neuly Listing Request</h1>
                                <p class="lead text-center">Your listing request has been submitted. Thanks!</p>
                                <p class="text-center">
                                    <a href="{{ route('home') }}" class="btn btn-dark">Back to Neuly</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')

            </main>

        </div>

    </div>
@endsection
