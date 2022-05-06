@extends('errors.layout')

@php
  $error_number = 403;
@endphp

@section('title')
  OOOOH! {{ $error_number }}, ACCESS DENIED
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but you don't have permission to access this page.";
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
  @endcan
@endsection
