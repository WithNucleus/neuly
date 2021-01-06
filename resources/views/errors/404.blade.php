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
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
