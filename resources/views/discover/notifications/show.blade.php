@extends('layouts.show-modal')

@section('content')

    <p class="lead-smaller my-3">
        {!! $notification->message !!}
    </p>

@endsection