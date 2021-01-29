@extends('errors.layout')

@php
  $error_number = 503;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, IT IS US NOT YOU!!!!!!!
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but our service is currently not available. <br /><br />Please try again later.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
