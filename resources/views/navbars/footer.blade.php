<nav class="d-md-flex flex-wrap align-items-center">
    @guest
        <a href="{{ route('login') }}" class="me-4">Register</a>
    @else
        <a href="{{ Auth::user()->dashboard_link }}" class="me-4">Dashboard</a>
    @endguest

    <a href="/terms-of-use" class="me-4">Terms</a>
    <a href="/privacy-policy" class="me-4">Privacy</a>
    <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#helpModal">
        Help Center
    </button>

    @include('navbars._help-modal')
</nav>
