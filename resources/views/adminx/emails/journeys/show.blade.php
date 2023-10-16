@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <livewire:admin.emails.journeys.manage-journey :emailJourney="$journey" />
    </div>
@endsection
