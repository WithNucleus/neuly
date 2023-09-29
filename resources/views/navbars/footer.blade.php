<nav class="order-lg-2 d-lg-flex flex-wrap align-items-start flex-grow-1 justify-content-end mb-3">
    <a href="{{ route('content.research.request') }}" class="me-3">Research</a>
    <a href="{{ route('discover.courses') }}" class="me-3">Education</a>
    <a href="{{ route('discover.bookable-listing.practitioners') }}" class="me-3">Care</a>
    <a href="{{ route('content.enterprise') }}" class="me-3">Enterprise</a>
    <a href="{{ route('content.api') }}" class="me-3">API</a>
    <a href="/terms-of-use" class="me-4">Terms</a>
    <a href="/privacy-policy" class="me-4">Privacy</a>
    @guest
        <a href="{{ route('register') }}" class="me-4">Register</a>
        <a href="{{ route('login') }}" class="me-4">Login</a>
    @else
        <a href="{{ Auth::user()->dashboard_link }}" class="me-4">Dashboard</a>
    @endguest
    <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#helpModal">
        Help
    </button>

    @include('navbars._help-modal')
</nav>
