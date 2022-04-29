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
                        <div class="card card-body mt-3 mt-lg-5 shadow">
                            <div class="mx-auto py-3" style="max-width: 640px;">
                                <h1 class="text-center text-primary">Request a Demo</h1>
                                <p class="lead muted text-muted text-center">Please fill out the form below to schedule a demo and we'll get back to you as soon as possible.</p>

                                @include('discover.includes.status-messages')


                                <form method="post" action="{{ route('feedback.store-demo') }}">
                                    @csrf
                                    @unless (Auth::check())
                                        <div class="row">
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="name" class="font-weight-bold">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="email" class="font-weight-bold">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                    @endunless
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="organization" class="font-weight-bold">Organization</label>
                                            <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="job_title" class="font-weight-bold">Your Title / Role</label>
                                            <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="font-weight-bold">How would you like to use Neuly?</label>
                                        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right" type="submit">submit</button>
                                    </div>
                                    @honeypot
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
