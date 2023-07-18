@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Neuly Lists' => route('member.follow-lists.index'),
            $list->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        @include('members.includes.status-messages')

        <div class="d-flex align-items-baseline justify-content-between">
            <h1>{{ $list->name }}</h1>

            <div class="mb-0 font-size-small d-inline-block ms-2">
            @if($list->is_public)
                @if($list->user->member_url == '')
                    <a href="{{ route('user.settings') }}" class="btn btn-link lead-smaller p-0 ms-2 text-secondary font-weight-bold text-decoration-none" data-toggle="tooltip" data-placement="top" title="Set your Neuly member URL before sharing">
                        <i class="fa-strong far fa-share-square fa-lg"></i> SHARE
                    </a>
                @else
                    <span data-toggle="tooltip" data-placement="top" title="Share">
                        <button class="btn btn-link lead-smaller p-0 ms-2 text-secondary font-weight-bold text-decoration-none" data-toggle="modal" data-target="#share-list" data-toggle="tooltip" data-placement="top" title="Share List">
                            <i class="fa-strong far fa-share-square fa-lg"></i> SHARE
                        </button>
                    </span>
                @endif
            @else
                <a href="{{ route('member.follow-lists.edit', $list->slug) }}" class="btn btn-link lead-smaller p-0 ms-2 text-secondary font-weight-bold text-decoration-none" data-toggle="tooltip" data-placement="top" title="This list must be public to share it">
                    <i class="fa-strong far fa-share-square fa-lg"></i> SHARE
                </a>
            @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

                        <div class="left-side mb-0 font-size-small me-3">
                            <i class="fa-strong far fa-clock"></i> Created {{ \Carbon\Carbon::parse($list->created_at)->format('M d, Y') }}
                            and last updated {{ \Carbon\Carbon::parse($list->updated_at)->diffForHumans() }}

                            @if($list->is_public)
                                <span class="text-success ms-3"><i class="fa-strong far fa-eye"></i> Public</span>
                                @if($list->user->member_url == '')
                                    <a href="{{ route('user.settings') }}" data-toggle="tooltip" data-placement="top" title="Set your Neuly member URL before sharing"><span class="ms-3 font-size-small badge badge-warning">Set your Neuly URL</span></a>
                                @endif
                            @else
                                <span class="text-muted ms-3"><i class="fa-strong far fa-lock-alt"></i> Private</span>
                            @endif
                        </div>

                        <div class="align-self-end pb-1 font-size-small">
                            @if($list->is_public && $list->user->member_url)
                                <a href="{{ route('members.follow-lists.public', [$list->user->member_url , $list->slug]) }}" class="btn btn-sm btn-accent me-2">
                                    <i class="fa-strong far fa-link"></i>
                                    <span>Public URL</span>
                                </a>
                            @endif
                            <a href="{{ route('member.follow-lists.edit', $list->slug) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fa-strong far fa-edit"></i>
                                <span>Edit List
                                </span></a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-list-{{$list->id}}">
                                <i class="fa-strong far fa-trash-alt"></i>
                                <span>Delete List</span>
                            </button>
                        </div>
                    </div>

                    @if ($list->description != '')
                        <p class="lead">
                            {{ $list->description }}
                        </p>
                    @endif

                    @include('members.data.follows', [
                        'follows'             => $list->followItems,
                        'show_more'           => false,
                        'shadow'              => false,
                        'show_action_items'   => true,
                        'show_list_name'      => false,
                    ])
                </div>
            </div>
        </div>
    </div>

    @if($list->user->member_url != '')
        @include('members.follow-lists.modals.share', [
            'shareUrl' => route('members.follow-lists.public', [$list->user->member_url , $list->slug]),
            'user' => $list->user,
        ])
    @endif
    @include('members.follow-lists.modals.delete')
@endsection
