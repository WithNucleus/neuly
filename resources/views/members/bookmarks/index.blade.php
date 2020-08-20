@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> Bookmarks</h1>

                @include('members.includes.status-messages')
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-xl-7">
                <p class="lead mb-1">Lists</p>
                @include('members.data.bookmark-lists', ['show_more' => false, 'shadow' => false])
            </div>

            <div class="col-12 col-md-6 col-xl-4 offset-xl-1 mt-4 mt-md-0">
                <h2 class="lead font-normal mb-"><i class="fad fa-edit text-secondary"></i> Create a List</h2>
                <div class="p-3 bg-white shadow-sm">
                    @include('members.bookmarks.create-list', ['sidebar' => true])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="lead mt-4 mb-1">Recent Bookmarks</p>
                @include('members.data.bookmarks', ['show_more_bookmarks' => true, 'shadow' => true, 'show_action_items' => true])
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

@endsection
