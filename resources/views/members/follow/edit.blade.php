@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12 clearfix">
                <h1 class="h2 float-left">
                    <i class="fad fa-clipboard-list text-info"></i> Editing subscription for "{{ $follow->followable->name ?? $follow->followable->title }}"
                </h1>
                <p class="font-size-small float-right d-inline-block ml-2">
                    <a href="{{ route('member.follow.show', $follow->id) }}" class="btn btn-primary">View</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @if($errors->any())
                        <div class="alert alert-danger mb-0" role="alert">
                            {{ $errors->first()  }}
                        </div>
                    @endif

                    <div class="action-items" style="display: none;">
                        <a href="{{ route('member.follow.index') }}" class="btn btn-dark">Follows List</a>
                    </div>

                    <form method="POST" action="{{ route('member.follow.update', $follow->id) }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="previous_url" value="{{ $previousUrl }}">

                        <div class="form-group">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="email_notification" id="email_notification" value="1" @if($follow->email_notification) checked @endif>
                                    <label class="form-check-label" for="email_notification">Email notifications</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="app_notification" id="app_notification" value="1" @if($follow->app_notification) checked @endif>
                                    <label class="form-check-label" for="app_notification">Neuly notifications</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Save</button>

                        </div>
                    </form>
                    <form method="post" action="{{ route('member.follow.destroy', $follow->id) }}">
                        <button type="submit" class="btn btn-danger" onclick="confirm('Are you sure?')">Unfollow</button>
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

@endsection
