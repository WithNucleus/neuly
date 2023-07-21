@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Social Accounts">
        <ul class="list-group list-group-flush">
            @foreach($socialProviders as $provider)
                <li class="list-group-item py-3 d-flex align-items-center">
                    <i class="fab fa-{{ $provider == 'facebook' ? 'facebook-f' : $provider }} fa-fw me-2"></i>
                    <span style="min-width: 110px">{{ ucfirst($provider) }}</span>
                    @if(isset($userSocialProfiles[$provider]))
                        <span class="badge bg-accent text-uppercase">connected</span>
                    @else
                        <a href="{{ route('user.settings.social.connect', $provider) }}" class="btn btn-primary rounded-0 btn-sm m-1">Connect</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </x-members.settings>
@endsection
