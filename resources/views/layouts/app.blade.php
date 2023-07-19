@include('layouts.includes.public-header')

@section('head')
    @livewireStyles
@endsection

<div id="app">
    @yield('content')
</div>

@include('layouts.includes.public-footer')
