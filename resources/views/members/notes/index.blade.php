@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Notes'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <div class="d-flex flex-wrap justify-content-between">
            <h1 class="my-3">Notes</h1>
            <div class="my-3">
                <a href="{{ route('member.notes.create') }}" class="btn btn-primary">
                    <i class="fa-strong far fa-file-circle-plus"></i>
                    <span>Add Note</span>
                </a>
            </div>
        </div>
        <div>
            @include('members.includes.status-messages')
            @include('members.data.notes', ['shadow' => false, 'show_more' => false])
        </div>
    </div>

@endsection
