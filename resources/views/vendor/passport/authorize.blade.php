@extends('layouts.plain')

@section('body-class', 'home-hero')

@section('content')

    @include('navbars.auth')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h1 class="h2 text-center text-primary page-title-default mb-4">Authorize "{{ $client->name }}"
                            to access your account?</h1>


                        <div class="row">
                            @if($client->logo && $client->description)
                                <div class="col-6 logo">
                                    <img style="max-width: 100%; max-height: 300px" src="{!! $client->logo !!}"/>
                                </div>
                                <div class="col-6 description">
                                    <p>{!! $client->description !!}</p>
                                </div>
                            @else
                                @if($client->logo)
                                    <div class="col-12 logo text-center">
                                        <img style="max-width: 100%; max-height: 300px" src="{!! $client->logo !!}"/>
                                    </div>
                                @elseif($client->description)
                                    <div class="col-12 description">
                                        <p>{!! $client->description !!}</p>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="mt-4 scopes">
                            <p><strong>This application will be able to:</strong></p>
                            <ul>
                                @if (count($scopes) > 0)
                                    @foreach ($scopes as $scope)
                                        <li>{{ $scope->description }}</li>
                                    @endforeach
                                @else
                                    <li>See your email address</li>
                                    <li>See your Neuly profile and membership</li>
                                @endif
                            </ul>
                        </div>

                        <div class="mt-4 buttons d-flex justify-content-center">
                            <!-- Authorize Button -->
                            <form class="" method="post" action="{{ route('passport.authorizations.approve') }}">
                                @csrf

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                            </form>

                            <!-- Cancel Button -->
                            <form class="" method="post" action="{{ route('passport.authorizations.deny') }}">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                <button class="btn btn-link">Cancel</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footers.mini')
@endsection
