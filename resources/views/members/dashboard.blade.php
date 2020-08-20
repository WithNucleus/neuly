@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    @include('members.includes.status-messages')

    <div class="row">
        <div class="col-12 col-md-6 col-xl-4">
            <h1 class="h2">
                <a href="{{ route('member.bookmarks.index') }}" class="text-dark"><i class="fad fa-clipboard-list text-info"></i> Bookmarks</a>
            </h1>
            <div class="p-4 bg-white shadow-sm">
                <p class="lead mb-1">Lists</p>
                @include('members.data.bookmark-lists', ['show_more' => true, 'shadow' => false])

                <p class="lead mt-4 mb-1">Recently Added</p>
                @include('members.data.bookmarks', ['show_more_bookmarks' => true, 'shadow' => false, 'show_action_items' => false])
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4 mt-5 mt-md-0">
            <h1 class="h2">
                <a href="{{ route('member.notes.index') }}" class="text-dark"><i class="fad fa-file-edit text-secondary"></i> Notes</a>
            </h1>
            <div class="p-4 bg-white shadow-sm">
                <p class="lead mb-1">Recent Notes</p>
                @include('members.data.notes', ['shadow' => false, 'show_more' => true])
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4 mt-5 mt-md-0">
            <h1 class="h2">
                <span class="text-dark"><i class="fad fa-eye text-secondary"></i> Recently Viewed</span>
            </h1>
            <div class="p-4 bg-white shadow-sm">
                @include('members.data.recently-viewed', ['shadow' => false, 'show_more' => false])
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4 mt-5">
            <h1 class="h2">
                <a href="{{ route('member.follow.index') }}" class="text-dark"><i class="fad fa-network-wired text-secondary"></i> Follows List</a>
            </h1>
            <div class="p-4 bg-white shadow-sm">
                @include('members.data.follows-list', ['shadow' => false, 'show_more' => true])
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

    <script src="{{ asset('js/formValidation.js') }}"></script>

@endsection
