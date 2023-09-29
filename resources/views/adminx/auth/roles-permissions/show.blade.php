@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Role: {{ $role->name }}</h1>
        <livewire:admin.auth.edit-role :role="$role" />
    </div>
@endsection
