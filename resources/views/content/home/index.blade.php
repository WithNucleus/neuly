@extends('layouts.app')

@section('body-class', 'home')

@section('content')

    @include('navbars.primary')

    @include('content.home._hero')
    @include('content.home._courses')
    @include('content.home._explore')
    @include('content.home._request-research')
    @include('content.home._neuly-care')
    @include('content.home._clinical-research')
    @include('content.home._pubco-index')
    @include('content.home._add-listing')
    @include('content.home._news')

    @include('footers.full')

@endsection

@section('livewire_scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script>
        const navElement = document.getElementById('primary-navbar');
        navElement.classList.remove('bg-primary');

        document.addEventListener("scroll", () => {
            let scrollPosition = window.scrollY;

            if (scrollPosition > 60) {
                navElement.classList.add('bg-primary');
            } else {
                navElement.classList.remove('bg-primary');
            }
        });
    </script>
@endsection
