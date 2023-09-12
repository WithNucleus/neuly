@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Users</h1>
        <livewire:admin.auth.users.index />
    </div>
@endsection
