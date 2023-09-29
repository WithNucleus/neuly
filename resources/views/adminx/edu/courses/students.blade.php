@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <div class="d-flex">
            <div style="width: 250px" class="me-4">
                @include('navbars.neuly-edu-logo')
            </div>
            <h1 class="h2 mt-1">Students</h1>
        </div>
        <livewire:admin.edu.students-list />
    </div>
@endsection
