@extends('errors.layout')

@php
    $error_number = 404;
@endphp

@section('title')
    Page Not Found
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but the page you are looking for doesn't exist.";
    @endphp
    @can('view logs')
        @isset($exception)
            {{ $exception->getMessage() }}
        @else
            {{ $default_error_message }}
        @endisset
    @else
        {{ $default_error_message }}
    @endcan
@endsection
