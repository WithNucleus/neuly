@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <h1 class="h2">
            <i class="fad fa-star text-info"></i> Follow Settings
        </h1>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @include('members.includes.status-messages')

                    <div class="action-items" style="display: none;">
                        <a href="{{ route('member.follow.index') }}" class="btn btn-dark">Follows List</a>
                    </div>

                    <p class="lead">
                        <a href="{{ route('member.follow.show', $follow->id) }}">{{ $follow->followable->name }}</a>
                    </p>

                    <form method="POST" action="{{ route('member.follow.update', $follow->id) }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="previous_url" value="{{ old('previous_url', $previousUrl) }}">

                        <div class="form-group">
                            <label class="font-weight-bold">List</label>
                            <select name="follow_list_id" class="form-control">
                                @foreach($lists as $list)
                                    <option value="{{ $list->id }}" {{ $list->id == $follow->follow_list_id ? 'checked' : '' }}>{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="notes" class="font-weight-bold">Notes</label>
                            <textarea name="notes" class="form-control">{{ $follow->notes }}</textarea>
                        </div>

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
                            <a class="btn btn-danger text-white" data-toggle="modal"
                                    data-target="#unfollow-modal-{{$follow->followable_id}}"><i class="fad fa-trash"></i> Unfollow</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('members.follow.modals.unfollow', [
        'followable_type' => $follow->followable_type,
        'followable_id' => $follow->followable_id,
        'name' => $follow->followable->name,
        'previous_url' => old('previous_url', $previousUrl)
    ])
    @include('members.includes.dashboard-end')
@endsection
