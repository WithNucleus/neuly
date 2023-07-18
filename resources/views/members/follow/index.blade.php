@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Following'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <h1>Following</h1>

        @include('members.includes.status-messages')

        <div>
            @include('members.data.follows', [
                'shadow' => false,
                'show_more' => false,
                'show_list_name' => true,
                'show_action_items' => true
            ])
        </div>
    </div>

@endsection
