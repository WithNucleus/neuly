<div class="nucleus-nav-tile">
    <button class="btn" id="toggle-nucleus-nav-tile" tabindex="1" data-toggle="tooltip" data-placement="left" title="Navigate Nucleus">
        <img src="{{ asset('images/nucleus-icon.png') }}" alt="Nucleus Menu"> <span class="sr-only">Nucleus Menu</span>
    </button>
</div>

<div id="nucleus-nav-menu-backdrop" style="display: none;"></div>
<div id="nucleus-nav-menu" style="display: none;">
    <p class="title">Explore</p>
    <ul class="nav-links">
        <li class="nav-link-item"><a href="{{ route('discover.organizations') }}">Organizations</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.people') }}">People</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.research') }}">Research</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.locations') }}">Locations</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.focus') }}">Focus</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.events') }}">Events</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.jobs') }}">Jobs</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.clinicaltrials') }}">Clinical Trials</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.index') }}">Pubco Index</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.investors') }}">Investors</a></li>
        <li class="nav-link-item"><a href="{{ route('discover.insights') }}">Insights</a></li>
    </ul>

    <p class="title">Neuly</p>
    <ul class="nav-links">
        <li class="nav-link-item"><a href="/about">About Us</a></li>
        <li class="nav-link-item"><a href="/what-data-is-included">What Data is Included</a></li>
        <li class="nav-link-item">Create a Profile <span class="badge badge-warning">Coming soon!</span></li>
        <li class="nav-link-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
        @guest
            <li class="nav-link-item"><a href="{{ route('register') }}">Register</a> / <a href="/login">Login</a></li>
        @else
            <li class="nav-link-item"><a href="{{ route('user.settings') }}">Settings</a></li>
            <li class="nav-link-item"><a href="/help">Help</a></li>
        @endguest
    </ul>
</div>

<link rel="stylesheet" href="{{ mix('css/nav-tiles.css') }}">
<script type="text/javascript" src="{{ mix('js/nav-tiles.js') }}"></script>
