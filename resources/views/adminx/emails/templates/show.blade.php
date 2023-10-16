@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <livewire:admin.emails.templates.manage-template :template="$template" />
    </div>
@endsection
