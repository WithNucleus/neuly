@extends('errors.layout')

@php
    $error_number = 403;
@endphp

@section('title')
    Access Denied
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but you don't have permission to access this.";
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
