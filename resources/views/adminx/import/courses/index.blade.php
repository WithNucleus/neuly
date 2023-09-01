@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Import Courses</h1>
        <p class="lead">Import CSV or Excel files. The <strong>unique field</strong> is <code>name</code></p>
        <div>
            <livewire:admin.import.courses.import />
        </div>
    </div>
@endsection
