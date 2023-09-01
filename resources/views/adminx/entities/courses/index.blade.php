@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Courses List</h1>
        <livewire:admin.entities.courses-index />
    </div>
@endsection
