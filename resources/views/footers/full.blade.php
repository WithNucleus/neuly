<footer class="primary-footer container-fluid">
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
                @include('navbars.footer')
            </div>
        </div>
    </div>
</footer>
