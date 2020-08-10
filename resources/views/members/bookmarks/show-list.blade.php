@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> {{ $list->name }}</h1>

            <div class="align-self-end pb-1 font-size-small">
                <a href="{{ route('member.bookmarks.edit-list', $list->slug) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>

                <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none" data-toggle="modal" data-target="#delete-list"><i class="fad fa-trash-alt"></i> Delete</button>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @if ($list->description != '')
                        <p class="lead">
                            {{ $list->description }}
                        </p>
                    @endif

                    @include('members.includes.status-messages')

                    @include('members.data.bookmarks', ['show_more_bookmarks' => false, 'shadow' => false, 'show_action_items' => true])
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

    <script src="{{ asset('js/formValidation.js') }}"></script>

    @include('members.bookmarks.delete-list-modal')

@endsection
