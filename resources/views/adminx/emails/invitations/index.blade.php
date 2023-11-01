@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>User Invitations</h1>
        <livewire:admin.emails.invitations.index />
    </div>
@endsection
