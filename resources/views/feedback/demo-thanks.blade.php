@extends('layouts.app')

@section('body-class', 'page-request home-hero')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        {{-- Sidebar and Content Area --}}
        <div class="row">
            <main id="content-main" role="main" class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="card mt-5 shadow">
                            <div class="card-body">
                                <h1 class="text-center text-primary">Thank you!</h1>
                                @include('discover.includes.status-messages')

                                <p class="text-center lead mb-1">We'll be in touch.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
