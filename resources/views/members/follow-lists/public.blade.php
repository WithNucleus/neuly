@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            $user->fullname => false,
            $list->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <h1>{{ $list->name }}</h1>

        <div class="d-flex align-items-baseline justify-content-between border-bottom mb-2 pb-2">

            <div class="lead">
                <i class="fa-strong far fa-at text-accent"></i>
                <span>{{ $user->name }} {{ $user->last_name }}</span>
            </div>

            <div>
                <span data-toggle="tooltip" data-placement="top" title="Share">
                    <button class="btn btn-link lead-smaller p-0 ml-2 text-secondary font-weight-bold text-decoration-none" data-toggle="modal" data-target="#share-list" data-toggle="tooltip" data-placement="top" title="Share List">
                        <i class="fa-strong far fa-share-square fa-lg"></i> SHARE
                    </button>
                </span>
            </div>
        </div>

        <div>
            @if ($list->description)
                <p class="lead">
                    {{ $list->description }}
                </p>
            @endif
        </div>

        <div>
            @include('members.data.follows', [
                'follows'             => $list->followItems,
                'shadow'              => false,
                'show_more'           => false,
                'show_action_items'   => false,
                'show_list_name'      => false,
                'public_list'         => true,
            ])
        </div>

    </div>

    @include('members.follow-lists.modals.share', [
        'shareUrl' => route('members.follow-lists.public', [$user->member_url , $list->slug]),
        'user'     => $user
    ])
@endsection
