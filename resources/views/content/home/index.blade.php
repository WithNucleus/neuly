@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    @include('content.home._hero')
    @include('content.home._news')
    @include('content.home._explore')
    @include('content.home._clinical-research')
    @include('content.home._courses')
    @include('content.home._neuly-care')

    @include('navbars.footer')

@endsection

@section('livewire_scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    @livewireScripts
@endsection
