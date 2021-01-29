@extends('errors.layout')

@php
  $error_number = 400;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, BAD REQUEST
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but we weren't able to compute your request.";
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
  @endcan
@endsection
