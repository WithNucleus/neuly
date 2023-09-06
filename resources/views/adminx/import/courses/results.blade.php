@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Imported Courses</h1>
        <livewire:admin.import.courses.import-results />
    </div>
@endsection
