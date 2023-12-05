@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Course Programs</h1>
        <livewire:admin.entities.relationships.course-programs />
    </div>
@endsection
