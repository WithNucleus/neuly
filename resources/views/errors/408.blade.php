@extends('errors.layout')

@php
    $error_number = 408;
@endphp

@section('title')
    Request Timeout
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but we were too slow.";
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
