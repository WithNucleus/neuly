@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Connected Applications">
        <ul class="list-group list-group-flush">
            @forelse($clientsConnected as $client)
                <li class="list-group-item py-3 d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-2">
                        {{ $client->name }}
                    </div>
                    <form class="d-inline" method="post" action="{{ route('user.settings.oauth.disconnectClient', $client->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-0 btn-sm m-1">Disconnect</button>
                    </form>
                </li>
            @empty
                <li class="list-group-item">
                     No connected applications yet
                </li>
            @endforelse
        </ul>
    </x-members.settings>
@endsection
