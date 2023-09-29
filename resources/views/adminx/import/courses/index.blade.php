@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Import Courses</h1>
        <div>
            <a href="{{ route('adminx.import.courses.results') }}" class="btn btn-accent">Import Results</a>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 my-4">
                <div class="border p-4 h-100">
                    <h2 class="h4">Upload Courses</h2>
                    <p class="lead">Import CSV or Excel files. The <strong>unique field</strong> is <code>name</code></p>
                    <livewire:admin.import.courses.import />
                </div>
            </div>
            <div class="col-12 col-lg-6 my-4">
                <div class="border p-4 h-100">
                    <h2 class="h4">Company Relationships</h2>
                    <p class="lead">Import CSV or Excel files. Entities will be <strong>matched</strong> by <code>name</code> fields</p>
                    <livewire:admin.import.courses.company-import />
                </div>
            </div>
        </div>
    </div>
@endsection
