@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="d-flex align-items-baseline justify-content-between">

            <h1 class="h2 float-left">
                <i class="fad fa-clipboard-list text-info"></i> {{ $note->title }}
            </h1>

            <div class="mb-0 d-inline-block ml-2">
                @if($member->member_url == '')
                    <a href="{{ route('user.settings') }}" class="btn btn-link p-0 ml-2 text-secondary" data-toggle="tooltip" data-placement="top" title="Set your Neuly member URL before sharing">
                        <i class="fad fa-share-square fa-lg"></i>
                    </a>
                @else
                    @if($note->visibility == 'public')
                        <button data-toggle="modal" data-target="#share-note" class="btn btn-link lead-smaller p-0 ml-2 text-secondary font-weight-bold text-decoration-none">
                            <i class="fad fa-share-square"></i> SHARE
                        </button>
                    @else
                        <a href="{{ route('member.notes.edit', $note->slug) }}" class="btn btn-link lead-smaller p-0 ml-2 text-secondary font-weight-bold text-decoration-none" data-toggle="tooltip" data-placement="top" title="Make this note public to share it">
                            <i class="fad fa-share-square"></i> SHARE
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">

                    @include('members.includes.status-messages')

                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom border-tertiary">

                        <div class="left-side mb-0 font-size-small mr-3">
                            <i class="fad fa-clock"></i> Created {{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y') }}
                                and last updated {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}

                            @if($note->visibility == 'private')
                                <span class="text-muted ml-3"><i class="fad fa-lock-alt"></i> Private</span>
                            @elseif($note->visibility == 'public')
                                <span class="text-success ml-3"><i class="fad fa-eye"></i> Public</span>
                                @if($member->member_url == '')
                                    <a href="{{ route('user.settings') }}"><span class="ml-1 font-size-small badge badge-warning">Set your Neuly URL</span></a>
                                @endif
                            @endif

                        </div>

                        <div class="right-side">
                            <a href="{{ route('member.notes.edit', $note->slug) }}" class="font-size-small text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>
                            <a href="{{ route('member.notes.destroy', $note->id) }}" class="font-size-small text-danger confirm-action text-decoration-none mr-4"><i class="fad fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>

                    <div class="trix-content">
                        {!! $note->trixRender("content") !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

    @include('members.notes.share-modal')

@endsection
