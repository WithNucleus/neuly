@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Notes' => route('member.notes.index'),
            'Edit Note'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container my-4">
        <div class="d-md-flex justify-content-between align-items-center mb-3">
            <h1>Editing: {{ $note->title }}</h1>
            <div>
                <button type="submit" class="submit btn btn-primary me-2">Save Note</button>
                <a href="{{ route('member.notes.show', $note->slug) }}" class="btn btn-secondary">View without Saving</a>
            </div>
        </div>
        <div>
            @trixassets

            <div class="alert alert-danger errors" style="display:none">
                <ul class="mb-0"></ul>
            </div>

            <div class="alert alert-success success" style="display:none">
                <p class="mb-0"></p>
            </div>

            <div class="action-items" style="display: none;">
                <a href="{{ route('member.notes.index') }}" class="btn btn-dark">All Notes</a>
                <a href="{{ route('member.notes.create') }}" class="btn btn-primary">New Note</a>
            </div>

            <form id="create-note" method="POST" action="{{ route('member.notes.update', $note->id) }}" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3 row">
                    <div class="col-12 col-md-6">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" class="form-control" placeholder="Untitled" name="title" value="{{ $note->title }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="slug" class="font-weight-bold">Note URL <small>(Must be unique)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">neuly.com/member/{{ Auth::user()->member_url ? Auth::user()->member_url : 'you' }}/</span>
                            </div>
                            <input type="text" class="form-control rounded-right" name="slug" value="{{ $note->slug }}">
                            <div class="valid-feedback text-success" style="display: none">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="public" class="font-weight-bold">Visibility</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="visibility" id="private" value="private" @if($note->visibility == 'private') checked @endif>
                            <label class="form-check-label" for="private">Private</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="visibility" id="public" value="public" @if($note->visibility == 'public') checked @endif>
                            <label class="form-check-label" for="public">Public</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="font-weight-bold">Content</label>
                    {{-- @trix(\App\Models\MemberNote::class, 'content', [ 'hideTools' => ['file-tools'] ]) --}}
                    {!! $note->trix('content') !!}
                </div>
                <div class="mb-3">
                    <button type="submit" class="submit btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    @include('members.includes.note-slug-scripts')

@endsection
