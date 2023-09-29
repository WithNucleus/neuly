@include('layouts.includes.public-header')

@section('head')
    @livewireStyles
@endsection

@include('navbars.primary')

<div class="container-fluid breadcrumbs-container bg-primary-subtle py-2">
    @yield('breadcrumbs')
</div>

<main class="entity-show-container" role="main">
    @yield('content')
    @include('footers.full')
</main>

@include('layouts.includes.public-footer')
