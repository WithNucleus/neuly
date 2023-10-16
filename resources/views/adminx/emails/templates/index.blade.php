@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Email Templates</h1>
        <livewire:admin.emails.templates.index />
        <div class="mt-5 px-4 py-3">
            <p class="h5 mb-0">Merge Fields</p>
            @include('adminx.emails.templates._merge-fields')
        </div>
    </div>
@endsection
