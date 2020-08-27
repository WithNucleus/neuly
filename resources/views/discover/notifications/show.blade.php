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
                    'Notifications' => route('dashboard.notifications.index')
                ]])
            </div>
        </div>
    </div>

    <div class="container">
        <main id="index-main" role="main">
            <div class="p-4 bg-white shadow-sm">
                <h1 class="mb-0 mr-5">{{ $notification->title }}</h1>

                <div class="row">
                    <div class="col-12">
                        <p class="lead-smaller">
                            {{ $notification->message }}
                        </p>
                    </div>
                </div>
            </div>

            @include('footers.mini')
        </main>
    </div>
@endsection