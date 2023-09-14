@extends('layouts.app')

@section('body-class', 'page-recruiting-trials bg-body-secondary')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container pt-0">

        <div class="py-4 py-xl-5 px-3 text-center">
            <div class="max-width-400 mx-auto mb-4">
                @include('navbars.neuly-care-logo')
            </div>
            <h1 class="purple-on-dark">Recruiting Clinical Trials</h1>
            <p class="lead mb-0 max-width-780 mx-auto">
                Interested in participating in a clinical trial as a patient or healthy volunteer?
                <span class="d-lg-block">Find clinical trials that are actively recruiting to find a match for you.</span>
            </p>
        </div>

        <div id="recruiting-trials-eligibility pb-5">
{{--            <div class="max-width-600 mb-5 mx-auto">--}}
{{--                <div id="autocomplete"></div>--}}
{{--            </div>--}}
            <div>
                <livewire:public.featured.recruiting-trials />
            </div>
        </div>

    </main>
    <div class="pt-5">
        @include('footers.full')
    </div>
@endsection

@section('livewire_scripts')
    <script src="{{ asset('js/recruiting-trials.js') }}"></script>
@endsection
