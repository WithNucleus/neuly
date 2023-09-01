@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Imported Clinical Trials</h1>
        <div class="my-3">
            <a href="{{ route('adminx.import.clinical-trials.import') }}" class="btn btn-accent">Import Clinical Trials</a>
        </div>
        <livewire:admin.import.clinical-trials.index />
    </div>
@endsection
