@extends('errors.layout')

@php
	$error_number = 500;
@endphp

@section('title')
    OOOOH! {{ $error_number }}, IT IS US NOT YOU!!!!!!!
@endsection

@section('description')
	@php
	  $default_error_message = "Sorry about that, but there was an error on our side. If this is happening repeatedly please inform us.";
	@endphp
    @can('view logs')
        {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
    @endcan
@endsection
