@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Neuly Care Requests</h1>
        <livewire:admin.care.bookable-listings.requests-index />
    </div>
@endsection
