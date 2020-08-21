@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12 clearfix">
                <h1 class="h2 float-left">
                    <i class="fad fa-clipboard-list text-info"></i> Notes
                </h1>
                <a href="{{ route('member.notes.create') }}" class="btn btn-primary float-right"><i class="fad fa-pencil"></i> Add Note</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @include('members.includes.status-messages')

                    @include('members.data.notes', ['shadow' => false, 'show_more' => false])
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')


@endsection
