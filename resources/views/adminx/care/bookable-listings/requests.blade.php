@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <div class="d-flex">
            <div style="width: 260px" class="me-4">
                @include('navbars.neuly-care-logo')
            </div>
            <h1 class="h2 mt-1">Bookable Inquiries</h1>
        </div>
        <livewire:admin.care.bookable-listings.requests-index />
    </div>
@endsection
