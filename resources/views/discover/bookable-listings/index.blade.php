@extends('layouts.app')

@section('body-class', 'page-neuly-care')

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
            <h1 class="text-transform-none text-center mb-0 max-width-780 mx-auto">
                Find practitioners and connect with the care you need. All in one place.
            </h1>
        </div>

        <div id="neuly-care-listings" class="container">
            <div class="max-width-600 mb-4 mx-auto">
                <div id="autocomplete"></div>
            </div>
            <livewire:public.featured.neuly-care />
        </div>

    </main>
    @include('footers.full')
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
