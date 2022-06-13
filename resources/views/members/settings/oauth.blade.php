@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')
    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Connected Applications</h1>

                    @include('navbars.tabs-user-settings')

                    <div class="py-4 col-12 col-lg-8">
                        @include('members.includes.status-messages')

                        @forelse($clientsConnected as $client)
                            <div class="row">
                                <div class="col-12">
                                    <span class="d-inline-block w-25">
                                        {{ $client->name }}
                                    </span>
                                    <form class="d-inline" method="post" action="{{ route('user.settings.oauth.disconnectClient', $client->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm m-1">Disconnect</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="row">
                                <div class="col-12">
                                    Applications are not connected.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')
@endsection
