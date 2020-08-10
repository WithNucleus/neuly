@extends('layouts.show-modal')

@section('content')

    <div class="row">
        <div class="col-12">

            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mb-0" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="col-12 col-md-6">

        @if ($lists->count() == count($lists_to_remove))
            <p>You've added this to your existing lists.<br><button data-toggle="tooltip" data-placement="top" title="Add List" class="btn btn-link p-0 load-ajax-modal text-left" data-title="Add List" data-path="{{ route('member.bookmarks.create-form') }}" data-toggle="modal" data-target="#dynamic-modal">Create a new list to save this again.</button></p>
        @else
            <form action="{{ route('member.bookmarks.store', ['entity' => $entity, 'entity_id' => $entity_id]) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf

                    <input type="hidden" name="entity" value="{{ $entity }}">
                    <input type="hidden" name="entity_id" value="{{ $entity_id }}">

                    <div class="form-group">
                        <label for="bookmark_list" class="font-weight-bold">List</label>
                        <select name="bookmark_list_id" id="bookmark-list" class="custom-select">
                            @foreach($lists as $list)
                                @if (in_array($list->id, $lists_to_remove))
                                    <option value="{{ $list->id }}" disabled>{{ $list->name }}</option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Bookmark Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $name }}">
                    </div>

                    <div class="form-group">
                        <label for="notes" class="font-weight-bold">Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="mt-2 btn btn-primary" {{ $lists->count() == count($lists_to_remove) ? 'disabled' : ''}}>Save</button>
                    </div>
            </form>
        @endif
        </div>

        <div class="col-12 col-md-5 offset-md-1">
            @if ($existing_bookmarks->count() > 0)
                <p class="lead mb-1">
                    <strong>Currently saved in:</strong>
                </p>
                <ul class="list-group rounded">
                    @foreach ($existing_bookmarks as $bookmark)
                        <li class="list-group-item p-0 list-group-item-action">
                            <a href="{{ route('member.bookmarks.show-list', $bookmark->list->slug) }}" class="text-decoration-none d-block py-2 px-3">
                                {{ $bookmark->list->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <p class="mt-3">
                <button data-toggle="tooltip" data-placement="top" title="Add List" class="btn btn-sm btn-secondary load-ajax-modal text-left" data-title="Add List" data-path="{{ route('member.bookmarks.create-form') }}" data-toggle="modal" data-target="#dynamic-modal"><i class="far fa-plus"></i> Add List</button>
            </p>
        </div>
    </div>

    <script src="{{ asset('js/formValidation.js') }}"></script>

    <script>
        /* On Discover Dropdown Change */
        $("select#bookmark-list").change(function(){

            // Get Value
            var value = $(this).val();

            // Redirect Based on Value
            if (value == 'new list') {
                window.location.replace("{{ route('member.bookmarks.index') }}");
            }


        });
    </script>

    @include('discover.includes.modal')

@endsection
