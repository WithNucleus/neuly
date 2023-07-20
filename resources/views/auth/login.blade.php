@extends('layouts.plain')

@section('body-class', 'plain-layout')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5">
        <h1 class="h2 text-center text-transform-none mb-3">Login to Neuly</h1>

        @if(session()->has('message'))
            <div class="alert alert-danger text-center mb-4">
                {{ session()->get('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-8 offset-md-4 pb-3">
                    <button type="submit" class="btn btn-lg btn-accent">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="ms-2" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="max-width-400 mx-auto my-4">
                <hr class="border-secondary">
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-1">Or login with</p>
                    @include('auth.includes.social-auth-buttons')
                </div>
            </div>

            <p class="text-center mt-3 font-weight-bold mb-0">
                Don't have an account? Get one <a href="{{ route('register') }}">here</a>
            </p>

        </form>
    </div>
</div>

@include('footers.mini')
@endsection
