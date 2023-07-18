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
        <h1>Neuly Lists</h1>

        <div class="row">
            <div class="col-12 col-md-6 col-xl-7">
                <p class="lead mb-1">Lists</p>
                @include('members.data.follow-lists', ['show_more' => false, 'shadow' => false])
            </div>

            <div class="col-12 col-md-6 col-xl-4 offset-xl-1 mt-4 mt-md-0">
                <h2 class="h4">
                    <i class="fa-strong far fa-file-circle-plus text-success"></i>
                    <span>Create a List</span>
                </h2>
                <div>
                    @include('members.follow-lists.includes.create-form')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="lead mt-4 mb-1">Recently Added</p>
                @include('members.data.follows', [
                    'show_more'         => true,
                    'shadow'            => true,
                    'show_action_items' => true,
                    'show_list_name'    => true
                ])
            </div>
        </div>
    </div>

@endsection
