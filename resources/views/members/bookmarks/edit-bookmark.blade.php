@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> Edit Bookmark</h1>
                <div class="p-4 bg-white shadow-sm">

                    @include('members.includes.status-messages')

                    <div class="col-lg-6 p-0">

                        <p class="lead">Currently listed in {{ $bookmark->list->name }}</p>
                        <form action="{{ route('member.bookmarks.update', $bookmark->id) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="previous_url" value="{{ $previous_url }}">

                            <div class="form-group">
                                <label for="name" class="sr-only">Bookmark Name</label>
                                <input type="text" class="form-control mr-2 mt-2" name="name" value="{{ $bookmark->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name" class="sr-only">Notes</label>
                                <textarea class="form-control" placeholder="Notes (optional)" name="notes">{{ $bookmark->notes }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="lists" class="lead-smaller">List</label>

                                @if ($lists->count() == count($lists_to_remove))
                                    <p>You've added this to all your existing lists.</p>
                                @else
                                    <select name="bookmark_list_id" id="bookmark-list" class="custom-select">
                                        <option value="{{ $bookmark->bookmark_list_id }}" selected>{{ $bookmark->list->name }}</option>
                                        @foreach($lists as $list)
                                            @if (in_array($list->id, $lists_to_remove))
                                                @if ($bookmark->bookmark_list_id != $list->id)
                                                    <option value="{{ $list->id }}" disabled>{{ $list->name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif

                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="mt-2 btn btn-primary">Save</button>
                            </div>

                        </form>

                        <p class="font-size-small mt-4">
                            Need another list? <button data-toggle="tooltip" data-placement="top" title="Add List" class="btn btn-link btn-sm p-0 load-ajax-modal text-left" data-title="Add List" data-path="{{ route('member.bookmarks.create-form') }}" data-toggle="modal" data-target="#dynamic-modal">Create a new one.</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

    <script src="{{ asset('js/formValidation.js') }}"></script>

@endsection
