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
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
  @endcan
@endsection
