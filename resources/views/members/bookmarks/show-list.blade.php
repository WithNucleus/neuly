@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')
    @include('members.includes.status-messages')

    <div class="container">
        <div class="d-flex align-items-baseline justify-content-between">
            <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> {{ $list->name }}</h1>

            <div class="mb-0 font-size-small d-inline-block ml-2">
            @if($list->is_public)
                @if($member->member_url == '')
                    <a href="{{ route('user.settings') }}" class="btn btn-link p-0 ml-2 text-secondary" data-toggle="tooltip" data-placement="top" title="Set your Neuly member URL before sharing">
                        <i class="fad fa-share-square fa-lg"></i>
                    </a>
                @else
                    <span data-toggle="tooltip" data-placement="top" title="Share">
                        <button class="btn btn-link p-0 ml-2 text-secondary" data-toggle="modal" data-target="#share-list" data-toggle="tooltip" data-placement="top" title="Share List">
                            <i class="fad fa-share-square fa-lg"></i>
                        </button>
                    </span>
                @endif
            @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom border-tertiary">

                        <div class="left-side mb-0 font-size-small mr-3">
                            <i class="fad fa-clock"></i> Created {{ \Carbon\Carbon::parse($list->created_at)->format('M d, Y') }}
                            and last updated {{ \Carbon\Carbon::parse($list->updated_at)->diffForHumans() }}

                            @if($list->is_public)
                                <span class="text-success ml-3"><i class="fad fa-eye"></i> Public</span>
                                @if($member->member_url == '')
                                    <a href="{{ route('user.settings') }}"><span class="ml-1 font-size-small badge badge-warning">Set your Neuly URL</span></a>
                                @endif
                            @else()
                                <span class="text-muted ml-3"><i class="fad fa-lock-alt"></i> Private</span>
                            @endif
                        </div>

                        <div class="align-self-end pb-1 font-size-small">
                            <a href="{{ route('member.bookmarks.edit-list', $list->slug) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>
                            <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none" data-toggle="modal" data-target="#delete-list"><i class="fad fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>

                    @if ($list->description != '')
                        <p class="lead">
                            {{ $list->description }}
                        </p>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @include('members.data.bookmarks', ['show_more_bookmarks' => false, 'shadow' => false, 'show_action_items' => true])
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')
    @include('members.bookmarks.share-modal', ['shareUrl' => route('members.public.bookmark-list', [$member->member_url , $list->slug])])
    @include('members.bookmarks.delete-list-modal')

    <script src="{{ asset('js/formValidation.js') }}"></script>
@endsection
