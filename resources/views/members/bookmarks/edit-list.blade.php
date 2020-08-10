@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> Edit List</h1>
                <div class="p-4 bg-white shadow-sm">

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mb-0" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('member.bookmarks.update-list', $list->id) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="sr-only">List Name</label>
                            <input type="text" class="form-control mr-2 mt-2" name="name" value="{{ $list->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name" class="sr-only">Description</label>
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
