@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <div class="d-flex">
            <div style="width: 350px" class="me-4">
                @include('navbars.neuly-research-logo')
            </div>
            <h1 class="h2 mt-1">Requests</h1>
        </div>
        <livewire:admin.research.research-requests-list />
    </div>
@endsection
