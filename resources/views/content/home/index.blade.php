@extends('layouts.app')

@section('body-class', 'home')

@section('content')

    @include('navbars.primary')

    @include('content.home._hero')
    @include('content.home._courses')
    @include('content.home._neuly-care')
    @include('content.home._explore')
    @include('content.home._news')
    @include('content.home._clinical-research')

    <div class="home-pubco-index bg-body-secondary py-5">
        <div class="container py-5 text-center">
            <h2 class="h1 text-body-emphasis mb-0">Stay Informed on Psychedelic Companies</h2>
            <div class="my-4">
                <a href="{{ route('discover.index') }}">
                    <img src="{{ asset('images/home/pubco-index.png') }}" alt="Browse the psychedelic company index">
                </a>
            </div>
            <div>
                <a href="{{ route('discover.index') }}" class="btn btn-lg btn-cta btn-primary">View Public Company Index</a>
            </div>
        </div>
    </div>

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
