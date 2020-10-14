<footer class="footer">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('images/neuly-logo-dark.png') }}" alt="Neuly" width="120" class="mb-1">
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4">
                <p class="description">Transparent information for entrepreneurs, investors, researchers, scientists, educators, policy makers, and anyone interested in the psychedelic industry.</p>
                <p class="terms">
                    <a href="/terms-of-use">Terms of Use</a> | <a href="/privacy-policy">Privacy Policy</a> | &copy; 2020 Neuly
                </p>
                <p class="mb-0">
                    <a href="/listing/request" class="font-weight-bold">Request Listing</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('job-report-entry.index') }}" class="font-weight-bold">Jobs Report</a>
                </p>
            </div>

            <div class="col-12 col-md-6 col-lg-3 offset-lg-1 mt-4 mt-md-0">
                <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Discover</p>
                <div class="d-flex">
                    <ul class="plain-list mb-0">
                        <li><a href="{{ route('discover.organizations') }}">Organizations</a></li>
                        <li><a href="{{ route('discover.people') }}">People</a></li>
                        <li><a href="{{ route('discover.research') }}">Research</a></li>
                        <li><a href="{{ route('discover.locations') }}">Locations</a></li>
                        <li><a href="{{ route('discover.focus') }}">Focus</a></li>
                        <li><a href="{{ route('discover.events') }}">Events</a></li>
                    </ul>
                    <ul class="plain-list mb-0 ml-4">
                        <li><a href="{{ route('discover.jobs') }}">Jobs</a></li>
                        <li><a href="{{ route('discover.clinicaltrials') }}">Clinical Trials</a></li>
                        <li><a href="{{ route('discover.index') }}">Pubco Index</a></li>
                        <li><a href="{{ route('discover.investors') }}">Investors</a></li>
                        <li><a href="{{ route('discover.insights') }}">Insights</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3 offset-lg-1 mt-4 mt-lg-0">
                <ul class="plain-list mb-0">
                    <li class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Helpful Links</li>
                    <li><a href="/about">About Neuly</a></li>
                    <li><a href="/what-data-is-included">What Data is Included</a></li>
                    <li>Create a Profile <span class="badge badge-warning">Coming soon!</span></li>
                    <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                    <li><a href="/help">Help</a></li>
                    @guest
                        <li><a href="{{ route('register') }}">Register</a> / <a href="/login">Login</a></li>
                    @else
                        <li><a href="{{ route('user.settings') }}">Settings</a></li>
                    @endguest
                </ul>
            </div>

        </div>

    </div>
</footer>
