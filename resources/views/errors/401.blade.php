@extends('errors.layout')

@php
  $error_number = 401;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, UNAUTHORIZED ACTION
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but you aren't authorized to access this page.<br /><br /><small>You have an account? - Please login.<br />Don't have an account yet? - Please register.</small>";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
