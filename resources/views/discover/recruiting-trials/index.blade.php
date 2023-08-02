@extends('layouts.app')

@section('body-class', 'page-recruiting-trials')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container pt-0">

        <div class="py-4 py-xl-5 px-3 text-center">
            <h1 class="text-accent">Recruting Clinical Trials</h1>
            <p class="lead mb-0 max-width-780 mx-auto">
                Interested in participating in a clinical trial as a patient or healthy volunteer? Explore the clinical trials that are actively recruiting to find a match for you.
            </p>
        </div>

        <div id="neuly-care-listings" class="container">
            <div class="max-width-600 mb-4 mx-auto">
                <div id="autocomplete"></div>
            </div>
            <livewire:public.featured.recruiting-clinical-trials />
        </div>

    </main>
@endsection

@section('livewire_scripts')
    <script src="https://cdn.jsdelivr.net/npm/@opencage/geosearch-bundle" type="text/javascript"></script>
    <script src="{{ asset('js/neuly-care.js') }}"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script>
        Livewire.on('gotoTop', () => {
            document.querySelector('#neuly-care-listings').scrollIntoView()
        });
    </script>
@endsection
