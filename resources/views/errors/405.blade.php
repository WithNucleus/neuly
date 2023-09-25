@extends('errors.layout')

@php
    $error_number = 405;
@endphp

@section('title')
    Method Not Allowed
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but you don't have permission to do this.";
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
