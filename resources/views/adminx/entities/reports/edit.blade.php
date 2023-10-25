@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Edit Industry Report</h1>
        <livewire:admin.entities.forms.edit-report :report="$report" />
    </div>
@endsection
