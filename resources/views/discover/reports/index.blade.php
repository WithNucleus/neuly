@extends('layouts.app')

@section('body-class', 'page-reports')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container">
        <div class="container">
            <div class="text-center">
                <div class="max-width-360 mx-auto mb-3">
                    @include('navbars.neuly-research-logo')
                </div>
                <h1 class="purple-on-dark">Industry Reports</h1>
                <livewire:public.featured.industry-reports />
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
