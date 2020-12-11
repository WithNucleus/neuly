@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')
    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Account Settings</h1>

                    @include('navbars.tabs-user-settings')

                    <div class="py-4 col-12 col-lg-8">
                        @include('members.includes.status-messages')

                        @foreach($socialProviders as $provider)
                            <div class="row">
                                <div class="col-12">
                                    <span class="d-inline-block w-25">
                                        <i class="fab fa-{{ $provider == 'facebook' ? 'facebook-f' : $provider }} mr-2"></i>
                                        {{ ucfirst($provider) }}
                                    </span>
                                    @if(isset($userSocialProfiles[$provider]))
                                        <span class="badge badge-success font-size-large">{{ $userSocialProfiles[$provider] }}</span>
                                    @else
                                        <a href="{{ route('user.settings.social.connect', $provider) }}" class="btn btn-primary btn-sm m-1">Add</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')
@endsection
