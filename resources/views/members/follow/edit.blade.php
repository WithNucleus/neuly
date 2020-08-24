@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <h1 class="h2">
            <i class="fad fa-network-wired text-info"></i> Follow Settings
        </h1>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @include('members.includes.status-messages')

                    <div class="action-items" style="display: none;">
                        <a href="{{ route('member.follow.index') }}" class="btn btn-dark">Follows List</a>
                    </div>

                    <p class="lead">
                        <a href="{{ route('member.follow.show', $follow->id) }}">{{ $follow->followable->name ?? $follow->followable->title }}</a>
                    </p>

                    <form method="POST" action="{{ route('member.follow.update', $follow->id) }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="previous_url" value="{{ $previousUrl }}">

                        <div class="form-group">
                            <div>
                                <strong class="d-block">Notifications:</strong>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="email_notification" id="email_notification" value="1" @if($follow->email_notification) checked @endif>
                                    <label class="form-check-label" for="email_notification">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="app_notification" id="app_notification" value="1" @if($follow->app_notification) checked @endif>
                                    <label class="form-check-label" for="app_notification">Neuly</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Save</button>
                        </div>
                    </form>
                    <form method="post" action="{{ route('member.follow.destroy', $follow->id) }}">
                        <button type="submit" class="btn confirm-action btn-sm btn-danger"><i class="fad fa-trash"></i> Unfollow</button>
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

@endsection
