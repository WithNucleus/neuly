@extends('errors.layout')

@php
    $error_number = 401;
@endphp

@section('title')
    Unauthorized Action
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but you aren't authorized to access this page.";
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
