<nav class="order-md-2 d-md-flex flex-wrap align-items-start flex-grow-1 justify-content-end mb-3">
    @guest
        <a href="{{ route('register') }}" class="me-4">Register <span class="d-none d-lg-inline">for Neuly</span></a>
        <a href="{{ route('login') }}" class="me-4">Login</a>
    @else
        <a href="{{ Auth::user()->dashboard_link }}" class="me-4">Dashboard</a>
    @endguest

    <a href="/terms-of-use" class="me-4">Terms</a>
    <a href="/privacy-policy" class="me-4">Privacy</a>
    <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#helpModal">
        Help
    </button>

    @include('navbars._help-modal')
</nav>
