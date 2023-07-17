@extends('layouts.app')

@section('body-class', 'page-focus')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container">

        <div class="container">
            <h1 class="text-body-emphasis text-center my-4">Explore Psychedelics by Focus &amp; Category</h1>

            <div class="container row mx-auto">
                <livewire:public.entities.focus-index />
            </div>
        </div>

    </main>
@endsection

@section('livewire_scripts')
    <script src="https://unpkg.com/alpinejs" defer></script>
    @livewireScripts
    <script>
        let directoryElement = document.querySelector('.entity-index-listings');
        let directoryTop = directoryElement.offsetTop - 100;
        Livewire.on('gotoTop', () => {
            directoryElement.scrollTop = directoryTop;
        });
    </script>
@endsection
