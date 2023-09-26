@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <div class="d-flex">
            <div style="width: 250px" class="me-4">
                @include('navbars.neuly-care-logo')
            </div>
            <h1 class="h2 mt-1">Inquiries</h1>
        </div>
        <livewire:admin.care.care-requests-list />
    </div>
@endsection
