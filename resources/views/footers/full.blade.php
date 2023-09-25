<footer class="primary-footer container-fluid">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end">
            <a class="navbar-brand" href="/">
                @include('navbars.neuly-logo')
            </a>
            <div class="w-auto">
                <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Send us an email!">
                    <i class="fa-sharp fa-solid fa-envelope fa-fw text-body-tertiary"></i>
                    <a href="mailto:hello@neuly.com">concierge@neuly.com</a>
                </div>
                <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Call or text us!">
                    <i class="fa-sharp fa-solid fa-phone-intercom fa-fw text-body-tertiary"></i>
                    <a href="tel:(866) 648-6254">(866) 648-6254</a>
                </div>
            </div>
        </div>
        <div class="border-top mt-4 pt-4">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between">
                <div class="order-2 order-md-1 me-3">&copy; <?php echo date('Y'); ?> Copyright Neuly, LLC. <span class="d-block d-lg-inline">All Rights Reserved.</span></div>
                @include('navbars.footer')
            </div>
        </div>
    </div>
</footer>
