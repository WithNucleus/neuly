@include('layouts.includes.public-header')

@section('head')
    @livewireStyles
@endsection

@include('navbars.primary')
<main class="entity-index-container" role="main">
    @yield('content')
</main>

@section('livewire_scripts')
    <script src="https://unpkg.com/alpinejs" defer></script>
    @livewireScripts
    <script>
        let directoryElement = document.querySelector('.entity-index-listings');
        let directoryTop = directoryElement.offsetTop - 60;
        Livewire.on('gotoTop', () => {
            directoryElement.scrollTop = directoryTop;
        });
    </script>
@endsection

@include('layouts.includes.public-footer')
