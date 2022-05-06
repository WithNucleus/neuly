@extends('errors.layout')

@php
  $error_number = 408;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, REQUEST TIMEOUT
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but we weren't able to process your request in time.";
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
  @endcan
@endsection
