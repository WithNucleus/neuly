<div id="discover-menu-button">
    <button class="btn btn-dark p-2" id="toggle-discover-menu" tabindex="1" data-toggle="tooltip" data-placement="left" title="Navigate Neuly">
        <img src="{{ asset('images/brain-icon-cyan.png') }}" alt="Neuly Menu"> <span class="sr-only">Neuly Menu</span></button>
</div>

<div id="discover-backdrop" style="display: none;"></div>
<div id="discover-menu" class="rounded shadow-sm" style="display: none;">
    <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Explore</p>
    <ul class="plain-list mb-2">
        <li><a href="{{ route('discover.organizations') }}">Organizations</a></li>
        <li><a href="{{ route('discover.people') }}">People</a></li>
        <li><a href="{{ route('discover.research') }}">Research</a></li>
        <li><a href="{{ route('discover.locations') }}">Locations</a></li>
        <li><a href="{{ route('discover.focus') }}">Focus</a></li>
        <li><a href="{{ route('discover.events') }}">Events</a></li>
        <li><a href="{{ route('discover.jobs') }}">Jobs</a></li>
        <li><a href="{{ route('discover.clinicaltrials') }}">Clinical Trials</a></li>
        <li><a href="{{ route('discover.index') }}">Pubco Index</a></li>
        <li><a href="{{ route('discover.investors') }}">Investors</a></li>
        <li><a href="{{ route('discover.insights') }}">Insights</a></li>
    </ul>

    <p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Neuly</p>
    <ul class="plain-list mb-0">
        <li><a href="/about">About Us</a></li>
        <li><a href="/what-data-is-included">What Data is Included</a></li>
        <li>Create a Profile <span class="badge badge-warning">Coming soon!</span></li>
        <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
        @guest
            <li><a href="{{ route('register') }}">Register</a> / <a href="/login">Login</a></li>
        @else
            <li><a href="{{ route('user.settings') }}">Settings</a></li>
            <li><a href="/help">Help</a></li>
        @endguest
    </ul>
</div>