@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Neuly Admin</h1>
        <p>Hey, {{ Auth::user()->name }}!</p>
    </div>
@endsection
