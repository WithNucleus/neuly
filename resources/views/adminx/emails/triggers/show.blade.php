@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1 class="mb-4">Email Trigger: {{ $trigger->name }}</h1>
        <p class="fs-5">{{ $trigger->description }}</p>
    </div>
@endsection
