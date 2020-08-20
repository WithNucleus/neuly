@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> Edit List</h1>
                <div class="p-4 bg-white shadow-sm">

                    @include('members.includes.status-messages')

                    <form action="{{ route('member.bookmarks.update-list', $list->id) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="name" class="font-weight-bold">List Name</label>
                                <input type="text" class="form-control mr-2 mt-2" name="name" value="{{ $list->name }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="slug" class="font-weight-bold">List URL <small>(Must be unique)</small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">neuly.com/member/{{ Auth::user()->member_url ? Auth::user()->member_url : 'you' }}/lists/</span>
                                    </div>
                                    <input type="text" class="form-control rounded-right" name="slug" value="{{ $list->slug }}">
                                    <div class="valid-feedback text-success" style="display: none">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="public" class="font-weight-bold">Visibility</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_public" id="private" value="0" {{ $list->is_public ? '' : 'checked' }}>
                                    <label class="form-check-label" for="private">Private</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_public" id="public" value="1" {{ $list->is_public ? 'checked' : '' }}>
                                    <label class="form-check-label" for="public">Public</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" placeholder="Description (optional)" name="description">{{ $list->description }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="mt-2 btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

    <script src="{{ asset('js/formValidation.js') }}"></script>

@endsection
