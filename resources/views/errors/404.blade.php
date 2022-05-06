@extends('errors.layout')

@php
    $error_number = 404;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, PAGE NOT FOUND
@endsection

@section('description')
    @php
        $default_error_message = "Sorry about that, but the page you are looking for doesn't exist.";
    @endphp
    @can('view logs')
        {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
    @endcan
@endsection
