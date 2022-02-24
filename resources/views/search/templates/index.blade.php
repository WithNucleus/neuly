@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">
                    <h1 class="page-title-default text-primary mb-4">Search Templates</h1>
                    <div class="mb-2 d-flex">
                        <span>Filter: </span>
                        <select class="filter-selection ml-2">
                            <option>all</option>
                            @foreach($types as $type)
                                <option>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                                <tr data-type="{{ $template->type }}">
                                    <td><a href="{{ $template->link }}">{{ $template->name }}</a></td>
                                    <td>{{ $template->type }}</td>
                                    <td>{{ $template->description }}</td>
                                    <td>
                                        <a href="{{ route('user.search.templates.update', ['template' => $template->id]) }}" class="btn btn-primary">edit</a>
                                        <a href="{{ route('user.search.templates.delete', ['template' => $template->id]) }}" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
