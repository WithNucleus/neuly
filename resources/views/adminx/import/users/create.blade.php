@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Import Users</h1>
        <div class="row">
            <div class="col-12 col-lg-6 my-4">
                <div class="border p-4 h-100">
                    <h2 class="h4">Invite Users</h2>
                    <livewire:admin.import.users.invite-users />
                </div>
            </div>
        </div>
    </div>
@endsection
