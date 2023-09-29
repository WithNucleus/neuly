@extends('layouts.app')

@section('body-class', 'page-focus')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container">

        <div class="container">

            <div class="max-width-500 mx-auto">
                @include('navbars.neuly-research-logo')
            </div>
            <h1 class="text-center my-4">
                <span class="purple-on-dark">Explore Psychedelics</span>
                <span class="d-block h4 text-body-secondary">by Treatment &amp; Category</span>
            </h1>

            <div class="container row mx-auto">
                <livewire:public.entities.focus-index />
            </div>
        </div>

    </main>
    @include('footers.full')
@endsection

@section('livewire_scripts')
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script>
        let directoryElement = document.querySelector('.entity-index-listings');
        let directoryTop = directoryElement.offsetTop - 100;
        Livewire.on('gotoTop', () => {
            directoryElement.scrollTop = directoryTop;
        });
    </script>
@endsection
