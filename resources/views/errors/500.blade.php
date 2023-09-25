@extends('errors.layout')

@php
	$error_number = 500;
@endphp

@section('title')
    It's us, not you.
@endsection

@section('description')
	@php
	  $default_error_message = "Sorry about that, but there was an error on our side. If this is happening repeatedly, please inform us.";
	@endphp
    @can('view logs')
        @isset($exception)
            {{ $exception->getMessage() }}
        @else
            {{ $default_error_message }}
        @endisset
    @else
        {{ $default_error_message }}
    @endcan
@endsection
