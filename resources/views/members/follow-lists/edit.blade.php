@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Neuly Lists' => route('member.follow-lists.index'),
            'Edit ' . $list->name => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <h1>Edit {{ $list->name }}</h1>
        @include('members.includes.status-messages')

        <form action="{{ route('member.follow-lists.update', $list->id) }}" method="post" class="max-width-780">
            @csrf
            @method('put')

            <div class="mb-3 row">
                <div class="col-12 col-md-6">
                    <label for="name" class="fw-bold">List Name</label>
                    <input type="text" class="form-control mr-2 mt-2" name="name" value="{{ $list->name }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="slug" class="fw-bold">List URL <small>(Must be unique)</small></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">neuly.com/member/{{ Auth::user()->member_url ? Auth::user()->member_url : 'you' }}/lists/</span>
                        </div>
                        <input type="text" class="form-control rounded-right" name="slug" value="{{ $list->slug }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="public" class="fw-bold">Visibility</label>
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

            <div class="mb-3">
                <label for="description" class="fw-bold">Description</label>
                <textarea class="form-control" placeholder="Description (optional)" name="description">{{ $list->description }}</textarea>
            </div>

            <div class="mb-3 mb-0">
                <button type="submit" class="mt-2 btn btn-primary">Save</button>
            </div>

        </form>
    </div>
@endsection
