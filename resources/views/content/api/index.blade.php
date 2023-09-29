@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container py-5">
        <div class="max-width-740 mx-auto mb-5 text-center">
             <div class="display-1 mb-2">
                <i class="fa-sharp fa-solid fa-plug-circle-check text-accent"></i>
            </div>
            <h1 class="text-primary">Neuly API</h1>
            <div class="text-start mx-auto">
                <livewire:public.opt-ins.research-requests.general-with-organization
                    requestType="{{ \App\Models\ResearchRequest::TYPE_API_REQUEST }}"
                    titleMessage="Interested in using our API? We're currently accepting applications and would love to connect with you about how we can help your organization!"
                    titleClasses="fs-6 text-body-emphasis text-center mb-3"
                    messageLabel="What are you interested in?"
                    successMessage="Thanks for your interest in"
                    showSuccessActions="true"
                />
            </div>
        </div>
    </div>

    @include('footers.full')

@endsection
