@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container py-5">
        <div class="max-width-740 mx-auto mb-5 text-center">
             <div class="max-width-400 mx-auto mb-3">
                 @include('navbars.neuly-research-logo')
             </div>
            <h1 class="purple-on-dark">Request a Research Report</h1>
            <div class="text-start max-width-600 mx-auto">
                <livewire:public.opt-ins.research-requests.general requestType="{{ \App\Models\ResearchRequest::TYPE_REPORT_REQUEST }}" titleClasses="fs-5 text-center text-body-emphasis mb-4" titleMessage="We'd love to help! Fill out the form below with your request for psychedelics research and/or data." />
            </div>
        </div>
    </div>

    @include('footers.full')

@endsection
