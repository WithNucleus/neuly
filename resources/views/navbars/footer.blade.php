<footer class="container-fluid bg-body">
    <div class="container py-5">
        <div class="d-flex justify-content-between">
            <a class="navbar-brand" href="/">
                @include('navbars.neuly-logo')
            </a>
            <a href="mailto:hello@neuly.com">hello@neuly.com</a>
        </div>
        <div class="border-top mt-4 pt-4">
            <div class="d-md-flex justify-content-between">
                <div>&copy; <?php echo date('Y'); ?> Neuly</div>
                <nav class="d-md-flex flex-wrap align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="me-4">Register</a>
                    @else
                        <a href="{{ route('member.dashboard') }}" class="me-4">Dashboard</a>
                    @endguest

                    <a href="/terms" class="me-4">Terms</a>
                    <a href="/privacy" class="me-4">Privacy</a>
                    <a href="/help">Help Center</a>
                </nav>
            </div>
        </div>
    </div>
</footer>
