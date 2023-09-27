@extends('layouts.entity-show')

@section('body-class', 'bg-body-tertiary')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Notifications'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <div>
            <livewire:members.notifications.notifications-list />
        </div>
    </div>

@endsection
