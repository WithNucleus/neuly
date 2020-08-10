@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="d-flex align-items-baseline justify-content-between">

            <h1 class="h2 float-left">
                <i class="fad fa-clipboard-list text-info"></i> {{ $note->title }}
            </h1>

            <div class="mb-0 font-size-small d-inline-block ml-2">

                <span data-toggle="tooltip" data-placement="top" title="Share">
                    <button data-toggle="modal" data-target="#share-note" href="" class="p-0 btn btn-link text-secondary ml-2" data-toggle="tooltip" data-placement="top" title="Share Note">
                        <i class="fad fa-share-square fa-2x"></i>
                    </button>
                </span>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">

                    {{-- @include('members.includes.status-messages') --}}

                    <div class="d-flex flex-wrap justify-content-between align-items-baseline mb-3 pb-2 border-bottom border-tertiary">

                        <div class="left-side mb-0 mr-3">
                            <i class="fad fa-at text-primary"></i> {{ $member->name }} {{ $member->last_name }}
                        </div>

                        <div class="right-side mb-0 font-size-small">
                            <i class="fad fa-clock"></i> Created {{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y') }} 
                                and last updated {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}
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
