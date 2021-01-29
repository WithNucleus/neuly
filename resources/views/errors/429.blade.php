@extends('errors.layout')

@php
  $error_number = 429;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, TO MANY REQUESTS
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but there were to many requests to handle them all at the same time.<br /><br />Please try again later.";
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
  @endcan
@endsection
