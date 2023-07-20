@extends('layouts.plain')

@section('body-class', 'plain-layout')

@section('content')

@include('navbars.auth')

    <div class="container">
        <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5">
            <h1 class="h2 text-center text-transform-none mb-3">Become 'Brain Healthy' with Neuly</h1>
            <p class="lead max-width-500 mx-auto text-center text-body-emphasis mb-4">Join today to get access to our extensive psychedelic database + your custom Neuly dashboard.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                @if($invitation)
                    <input type="hidden" name="team_id" value="{{ $invitation->team_id }}" />
                    <input type="hidden" name="role" value="Team member" />
                    <p class="help-block">Register as team member by invitation from {{ $invitedByName }}</p>
                @else
                    <div class="mb-3 lead">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="radioUserRole1" name="role" value="Subscriber" checked
                                   onchange="document.getElementById('team-block').style.display = 'none';">
                            <label class="form-check-label" for="radioUserRole1">Subscriber</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="radioUserRole2" name="role" value="Team owner"
                                   onchange="document.getElementById('team-block').style.display = 'block';">
                            <label class="form-check-label" for="radioUserRole2">
                                <span class="me-2">Team</span><i class="fa fa-question-circle text-primary-emphasis" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Need to bring your team to Neuly? Collaborative features coming soon!"></i>
                            </label>
                        </div>
                    </div>
                @endif

                <div id="team-block" class="mb-3" style="display: none;">
                    <label for="team_name" class="fw-bold">Team Name</label>
                    <input id="team_name" type="text" class="form-control @error('team_name') is-invalid @enderror" name="team_name" value="{{ old('team_name') }}" />

                    @error('team_name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <label for="name" class="fw-bold">First Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="first_name" autofocus>

                        @error('name')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="last_name" class="fw-bold">Last Name</label>
                        <input id="last_name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="fw-bold">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ $invitation ? $invitation->email : old('email') }}" required
                           autocomplete="email" {{ $invitation ? 'readonly' : '' }}>

                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <label for="password" class="fw-bold">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="fw-bold">{{ __('Password') }}</label>
                        <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div>
                    <div class="mb-4">
                        {!! htmlFormSnippet() !!}
                        @error('recaptcha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary me-2">
                        {{ __('Register') }}
                    </button>
                    Already a member? <a href="{{ route('login') }}">Login here.</a>
                </div>
            </form>

            @if($invitation === null)
                <div class="max-width-400 mx-auto mt-5 mb-4">
                    <hr class="border-secondary">
                </div>

                <div id="social-auth-block" class="row">
                    <div class="col-12 text-center">
                        <p class="mb-1">Or signup with</p>
                        @include('auth.includes.social-auth-buttons')
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('footers.mini')
@endsection
