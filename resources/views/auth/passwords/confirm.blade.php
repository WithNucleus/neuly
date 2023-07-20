@extends('layouts.plain')

@section('body-class', 'plain-layout')

@section('content')

@include('navbars.auth')

<div class="container">
        <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5">
            <h1 class="h2 text-center text-transform-none mb-3">Confirm Password</h1>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4 row">
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

                <div class="row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
