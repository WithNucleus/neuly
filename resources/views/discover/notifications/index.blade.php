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
                    Showing {{ $notifications->total() }} Notifications ({{$unread->count()}} new) <a href="#" class="btn read-all-button">mark all as read</a>
                </span>
            </div>

            {{-- Notifications --}}
            <ul class="list-group list-group-flush mb-4 shadow-sm">
                @forelse($notifications as $notification)
                    <li class="list-group-item single-notification p-3" data-notification-id="{{ $notification->id }}">

                        <div class="d-flex align-items-center">
                            <div class="bookmark-image mr-2 flex-shrink-0">
                                @if ($notification->icon !== '')
                                    <img src="{{ asset('images/icons/' . $notification->icon . '.svg') }}" alt="{{ $notification->title}}">
                                @endif
                            </div>
                            <p class="my-0">
                                <button class="load-ajax-modal btn btn-link p-0 {{ $notification->was_read === 0 ? 'text-secondarydark btn-lg font-weight-bold' : 'text-dark lead-smaller'}}" data-title="{{ $notification->title}}" data-path="{{ route('dashboard.notifications.show', $notification->id) }}" data-toggle="modal" data-target="#dynamic-modal">
                                    {{ $notification->title}}
                                </button>
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

    @include('discover.notifications.modal')

    <script>
        $('.load-ajax-modal').click(function() {
            $(this).removeClass('text-secondarydark btn-lg font-weight-bold');
            $(this).addClass('text-dark lead-smaller');
        });
    </script>

    @include('footers.mini')

@endsection
