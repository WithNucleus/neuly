@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">
                    <h1 class="page-title-default text-primary mb-4">Update Search Template</h1>
                    <form action="{{ route('user.search.templates.update', ['template' => $template->id]) }}" method="post">
                        @method('PATCH')
                        <div class="col">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $template->name }}" />
                        </div>
                        <div class="col">
                            <label for="type" class="form-label">Type:</label>
                            <input type="text" class="form-control" name="type" value="{{ $template->type }}" />
                        </div>
                        <div class="col">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" name="description">{{ $template->description }}</textarea>
                        </div>
                        @csrf
                        <div class="col d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
