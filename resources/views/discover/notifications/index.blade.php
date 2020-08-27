@extends('layouts.app')

@section('body-class', 'page-locations bg-light')

@section('content')

@include('navbars.primary')

    <div class="container-fluid">
        {{-- Discover Tabs Desktop --}}
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>
    </div>

    {{-- Discover Tabs Mobile --}}
    @include('navbars.tabs-mobile')

    <div class="container-fluid">
        {{-- Breadcrumbs --}}
        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                @include('navbars.breadcrumb', [
                'items' => [
                    'Dashboard' => route('member.dashboard'),
                    'Notifications' => false
                ]])
            </div>
        </div>
    </div>

    <div class="container">
        <main id="index-main" role="main" class="col-12">
            <div class="d-md-flex justify-content-between mb-1">
                <h1 class="mb-0 mr-5">Notifications</h1>

                <span class="lead-smaller align-self-end pb-1">
                    Showing {{ $notifications->total() }} Notifications ({{$unread->count()}} new)
                </span>
            </div>

            {{-- Notifications --}}
            <ul class="list-group list-group-flush mb-4 shadow-sm">
                @forelse($notifications as $notification)
                    <li class="list-group-item p-4 d-md-flex">

                        <div class="text">
                            <p class="lead-smaller mb-1 mt-1">
                                <a href="{{ route('dashboard.notifications.show', $notification->id) }}">{{ $notification->title}}</a>
                            </p>
                        </div>

                    </li>
                @empty
                <li class="list-group-item">
                    <p class="lead mb-0">
                        There are no more notifications for you.
                    </p>
                </li>
                @endforelse
            </ul>
        </main>

    </div>

    @include('footers.mini')

@endsection