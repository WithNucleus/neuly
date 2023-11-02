@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Imported Users / Emails</h1>
        <div class="my-3">
            <a href="{{ route('adminx.import.users.create') }}" class="btn btn-accent">Import Users</a>
        </div>
        <livewire:admin.import.users.index />
    </div>
@endsection
