@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1 class="mb-5">Email Template: {{ $template->name }}</h1>
        <x-admin.emails.email-template-details :emailTemplate="$template" />
    </div>
@endsection
