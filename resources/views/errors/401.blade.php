@extends('errors.layout')

@php
  $error_number = 401;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, UNAUTHORIZED ACTION
@endsection

@section('description')
  @php
    $default_error_message = "Sorry about that, but you aren't authorized to access this page.<br /><br /><small>You have an account? - Please <a href='" . route('login') . "'>login</a>.<br />Don't have an account yet? - Please <a href='" . route('register') . "'>register</a>.</small>";
  @endphp
  @can('view logs')
      {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
  @endcan
@endsection
