@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Notes'  => route('member.notes.index'),
            $note->title => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <div class="d-flex flex-wrap align-items-baseline justify-content-between">

            <h1 class="h2">{{ $note->title }}</h1>

            <div class="mb-2">
                @if($member->member_url == '')
                    <a href="{{ route('user.settings') }}" class="btn btn-success h5 btn-cta text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Set your Neuly member URL before sharing">
                        <i class="fad fa-share-square fa-lg"></i> SHARE
                    </a>
                @else
                    @if($note->visibility == 'public')
                        <button data-bs-toggle="modal" data-bs-target="#share-note" class="btn btn-success h5 btn-cta text-white">
                            <i class="fad fa-share-square"></i> SHARE
                        </button>
                    @else
                        <a href="{{ route('member.notes.edit', $note->slug) }}" class="btn btn-success h5 btn-cta text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Make this note public to share it">
                            <i class="fad fa-share-square"></i> SHARE
                        </a>
                    @endif
                @endif
            </div>
        </div>

        <div>

            @include('members.includes.status-messages')

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom border-tertiary">

                <div class="left-side mb-0 font-size-small mr-3">
                    <i class="fad fa-clock"></i> Created {{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y') }}
                        and last updated {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}

                    @if($note->visibility == 'private')
                        <span class="text-muted ms-3"><i class="fad fa-lock-alt"></i> Private</span>
                    @elseif($note->visibility == 'public')
                        <span class="text-success ms-3"><i class="fad fa-eye"></i> Public</span>
                        @if($member->member_url == '')
                            <a href="{{ route('user.settings') }}"><span class="ml-1 font-size-small badge badge-warning">Set your Neuly URL</span></a>
                        @endif
                    @endif

                </div>

                <div class="right-side">
                    <a href="{{ route('member.notes.edit', $note->slug) }}" class="btn btn-sm btn-primary me-2">
                        <i class="fa-strong far fa-edit"></i>
                        <span>Edit Note</span>
                    </a>
                    <a href="{{ route('member.notes.destroy', $note->id) }}" class="btn btn-sm btn-danger confirm-action">
                        <i class="fa-strong far fa-edit"></i>
                        <span>Delete Note</span>
                    </a>
                </div>
            </div>

            <div class="trix-content">
                {!! $note->trixRender("content") !!}
            </div>

        </div>
    </div>

    @include('members.notes.share-modal')

@endsection
