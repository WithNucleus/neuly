@extends('errors.layout')

@php
    $error_number = 429;
@endphp

@section('title')
    Too Many Requests
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but there were too many requests. If you know what caused this, slow down or try later.";
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
