@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="d-flex align-items-baseline justify-content-between">
            <h1 class="h2">
                {{ $list->name }}
            </h1>

            <div class="mb-0 font-size-small d-inline-block ml-2">
                <span data-toggle="tooltip" data-placement="top" title="Share">
                    <button class="btn btn-link lead-smaller p-0 ml-2 text-secondary font-weight-bold text-decoration-none" data-toggle="modal" data-target="#share-list" data-toggle="tooltip" data-placement="top" title="Share List">
                        <i class="fad fa-share-square fa-lg"></i> SHARE
                    </button>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">

                    <div class="d-flex flex-wrap justify-content-between align-items-baseline mb-3 pb-2 border-bottom border-tertiary">

                        <div class="left-side mb-0 mr-3">
                            <i class="fad fa-at text-primary"></i> {{ $member->name }} {{ $member->last_name }}
                        </div>
                    </div>

                    @if ($list->description != '')
                        <p class="lead">
                            {{ $list->description }}
                        </p>
                    @endif

                    @include('members.data.bookmarks', [
                        'show_more_bookmarks' => false,
                        'shadow'              => false,
                        'show_action_items'   => false,
                        'public_view'         => true,
                        'hide_list_name'      => true,
                    ])
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')
    @include('members.bookmarks.share-modal', ['shareUrl' => route('members.public.bookmark-list', [$member->member_url , $list->slug])])
@endsection
