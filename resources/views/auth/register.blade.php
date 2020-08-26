@extends('layouts.plain')

@section('body-class', 'home-hero')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="bg-light shadow-sm p-3 p-md-4 p-lg-5">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0 pr-lg-5">

                <h1 class="h2 text-center text-primary page-title-default mb-4">Join {{ config('app.name', 'Neuly') }}</h1>

                <p class="lead-smaller">
                    By having a Neuly account, you'll get access to our extensive psychedelic database + your dashboard to follow & save info, take notes, and more.
                </p>

                <ul class="plain-list d-none d-md-block">
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="font-size-large">Browse our entire database</strong><br>
                        Neuly is updated daily with the latest information in the psychedelics industry.
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="font-size-large">Collect &amp; organize your info</strong><br>
                        Document your findings, make connections, and keep all your data together in one place.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-secondarydark"></i> <strong class="font-size-large">Neuly's tools to help you</strong><br>
                        Bookmark, follow, and take notes - plus insights coming soon!
                    </li>
                </ul>
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
                        <div class="col-12">
                            <label for="member_url" class="font-weight-bold">{{ __('Member URL') }} <small>(optional)</small></label>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">neuly.com/member/</div>
                                </div>
                                <input id="member_url" type="text" class="form-control @error('member_url') is-invalid @enderror" name="member_url" value="{{ old('member_url') }}">
                            </div>
                            <small>Letters, numbers, dashes only</small>

                            @error('member_url')
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
                        <button type="submit" class="btn btn-primary mr-2">
                            {{ __('Register') }}
                        </button>
                        <small>Already a member? <a href="{{ route('login') }}">Login here.</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footers.mini')
@endsection