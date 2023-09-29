@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Team'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <h1>Team</h1>
        @include('members.includes.status-messages')
        @include('members.data.team-owner')
    </div>

@endsection
