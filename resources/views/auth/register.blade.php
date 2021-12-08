@extends('layouts.plain')

@section('body-class', 'home-hero')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="bg-light shadow-sm p-3 p-md-4 p-lg-5">
        <div class="row">
            <div class="col-12">
                <h1 class="h2 text-center text-primary page-title-default mb-4">Signup for a free {{ config('app.name', 'Neuly') }} account</h1>
            </div>
            <div class="col-12 col-lg-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if($teamOwner)
                    <input type="hidden" name="team_owner_id" value="{{ $teamOwner->id }}" />
                    <input type="hidden" name="role" value="Team member" />

                    <p class="help-block">Register as team member by invitation from {{ $teamOwner->fullname }}</p>
                    @else
                    <div class="form-group row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="radioUserRole1" name="role" value="Subscriber" checked
                                       onchange="document.getElementById('socialAuth').style.visibility = 'visible';">
                                <label class="form-check-label" for="radioUserRole1">Subscriber</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="radioUserRole2" name="role" value="Team owner"
                                       onchange="document.getElementById('socialAuth').style.visibility = 'hidden';">
                                <label class="form-check-label" for="radioUserRole2">Team</label>
                            </div>
                        </div>
                    </div>
                    @endif

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

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $invitedEmail ? $invitedEmail : old('email') }}" required
                                   autocomplete="email" {{ $invitedEmail ? 'readonly' : '' }}>

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

                @if($teamOwner === null)
                <div id="socialAuth" class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="mb-1">Or signup with</p>
                        @include('auth.includes.social-auth-buttons')
                    </div>
                </div>
                @endif
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
    </div>
</div>

@include('footers.mini')
@endsection
