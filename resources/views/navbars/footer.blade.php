<nav class="d-md-flex flex-wrap align-items-center">
    @guest
        <a href="{{ route('login') }}" class="me-4">Register</a>
    @else
        <a href="{{ Auth::user()->dashboard_link }}" class="me-4">Dashboard</a>
    @endguest

    <a href="/terms-of-use" class="me-4">Terms</a>
    <a href="/privacy-policy" class="me-4">Privacy</a>
    <a href="/help">Help Center</a>
</nav>
