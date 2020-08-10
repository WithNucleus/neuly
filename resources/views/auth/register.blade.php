@extends('layouts.plain')

{{-- @section('body-class', 'bg-dark bg-brains') --}}

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8">
            <div class="bg-white shadow-sm p-4">

                <h1 class="h2 text-center text-primary page-title-default mb-4">Join {{ config('app.name', 'Neuly') }}</h1>

                <div class="row">

                    <div class="col-12 col-lg-8 mx-auto">
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

                            <div class="form-group row mb-0">
                                <div class="col-12 text-center mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
