@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12 clearfix">
                <h1 class="h2 float-left">
                    <i class="fad fa-star text-info"></i> Following
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include('members.includes.status-messages')

                <div class="p-4 bg-white shadow-sm">
                    @include('members.data.follows', [
                        'shadow' => false,
                        'show_more' => false,
                        'show_list_name' => true,
                        'show_action_items' => true
                    ])
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

@endsection
