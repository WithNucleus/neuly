@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Clinical Trials List</h1>
        <livewire:admin.entities.clinical-trials-index />
    </div>
@endsection
