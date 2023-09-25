@extends('errors.layout')

@php
    $error_number = 503;
@endphp

@section('title')
    It's us, not you.
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, we're having a problem. Please try again later.";
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
