@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1 class="mb-4">Email Trigger: {{ $trigger->name }}</h1>
        <p class="fs-5">{{ $trigger->description }}</p>

        @if($trigger->autoResponse)
            <hr class="my-4">
            <h2>User Auto Response</h2>
            <x-admin.emails.email-template-details :emailTemplate="$trigger->autoResponse" showTemplateLink="true" />
        @endif

        @if($trigger->partnerResponse)
            <hr class="my-4">
            <h2>Partner Auto Response</h2>
            <x-admin.emails.email-template-details :emailTemplate="$trigger->partnerResponse" showTemplateLink="true" />
        @endif

        @if($trigger->adminResponse)
            <hr class="my-4">
            <h2>Admin Auto Response</h2>
            <livewire:admin.emails.triggers.admin-emails-widget :trigger="$trigger" />
            <x-admin.emails.email-template-details :emailTemplate="$trigger->adminResponse" showTemplateLink="true" />
        @endif

        @if($trigger->emailJourney)
            <hr class="my-4">
            <livewire:admin.emails.journeys.manage-journey :emailJourney="$trigger->emailJourney" />
        @endif
    </div>
@endsection
