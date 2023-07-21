@extends('layouts.app')

@section('body-class', 'bg-body-secondary')

@section('content')

    @include('navbars.primary')

    <div class="container my-5 text-center">
        <h1>{{ $page->title }}</h1>
        <div class="text-start max-width-1000 mx-auto bg-body p-4">
            {!! $page->content !!}
        </div>
    </div>

    @include('footers.mini')

@endsection
