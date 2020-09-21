@extends('layouts.plain')

@section('body-class', 'home-hero')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="bg-light shadow-sm p-3 p-md-4 p-lg-5">
        <div class="row">
            <div class="col-12">
                <h1 class="h2 text-center text-primary page-title-default mb-4">Join {{ config('app.name', 'Neuly') }}</h1>
            </div>
            <div class="col-12 col-lg-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="name" class="font-weight-bold">First Name</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="first_name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="last_name" class="font-weight-bold">Last Name</label>

                            <input id="last_name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="email" class="font-weight-bold">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="password" class="font-weight-bold">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="password-confirm" class="font-weight-bold">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group mb-0 mt-4">
                        <button type="submit" class="btn btn-dark mr-2">
                            {{ __('Register') }}
                        </button>
                        Already a member? <a href="{{ route('login') }}">Login here.</a>
                    </div>
                </form>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="mb-1">Or signup with</p>
                        @include('auth.includes.social-auth-buttons')
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-3 pl-lg-5">
                <ul class="plain-list">
                    <li class="mb-4">
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="lead-smaller">Explore the entire Neuly database</strong><br>
                        Our database is updated daily with the latest information about the psychedelics industry.
                    </li>
                    <li class="mb-4">
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="lead-smaller">Collect &amp; organize your info</strong><br>
                        Keep track of your research, organize your findings, and get alerts so you can stay on the cutting edge of psychedelics.
                    </li>
                    <li class="mb-4">
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="lead-smaller">Custom Neuly member dashboard</strong><br>
                        Bookmark, follow, and take notes. Then, share your work via email, social, or create a custom public URL.
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-5">
            <div class="row">
                <div class="mt-3 col-12 text-center">
                    <strong class="d-block h3 text-primary mb-0">How Neuly Can Help You</strong>
                    <p class="lead mb-4">We've made complicated data and information easy to understand.</p>
                </div>
            </div>
            <div class="row d-flex flex-wrap">
                <div class="col-12 col-sm-6 col-lg-4 mb-5">
                    <strong class="d-block h4 mb-1">Entrepreneurs <span class="float-right"><i class="fad fa-business-time text-secondarydark"></i></span></strong>
                    <p class="mb-0">Find high-quality, low-cost solutions for your start up.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5">
                    <strong class="d-block h4 mb-1">Scientists <span class="float-right"><i class="fad fa-microscope text-secondarydark"></i></span></strong>
                    <p class="mb-0">Share your findings with a dedicated network of experts.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5">
                    <strong class="d-block h4 mb-1">Investors <span class="float-right"><i class="fad fa-hands-usd text-secondarydark"></i></span></strong>
                    <p class="mb-0">Stay up to date about company progress with alerts.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5">
                    <strong class="d-block h4 mb-1">Educators <span class="float-right"><i class="fad fa-books text-secondarydark"></i></span></strong>
                    <p class="mb-0">Provide your students with the most relevant information.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5 mb-lg-0">
                    <strong class="d-block h4 mb-1">Researchers <span class="float-right"><i class="fad fa-business-time text-secondarydark"></i></span></strong>
                    <p class="mb-0">Stop hunting for information across multiple platforms.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5 mb-lg-0">
                    <strong class="d-block h4 mb-1">Students <span class="float-right"><i class="fad fa-graduation-cap text-secondarydark"></i></span></strong>
                    <p class="mb-0">Access a deep database of resources.</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-5 mb-lg-0">
                    <strong class="d-block h4 mb-1">Policy Makers <span class="float-right"><i class="fad fa-landmark text-secondarydark"></i></span></strong>
                    <p class="mb-0">Understand industry data to help you make informed decisions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footers.mini')
@endsection
