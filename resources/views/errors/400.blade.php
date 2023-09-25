@extends('errors.layout')

@php
    $error_number = 400;
@endphp

@section('title')
    Bad Request
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but we weren't able to compute your request.";
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
