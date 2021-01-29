@extends('errors.layout')

@php
  $error_number = 405;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, METHOD NOT ALLOWED
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but you tried to request this page by an unsupported method.";;
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
  @endcan
@endsection
