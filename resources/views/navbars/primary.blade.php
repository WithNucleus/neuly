<nav id="primary-navbar" class="navbar navbar-expand-lg bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            @include('navbars.neuly-logo')
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-lg-3 me-auto my-3 my-lg-0">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 border-primary-subtle" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn text-primary rounded-0 px-2" type="submit" aria-label="Search">
                        <i class="far fa-search"></i>
                    </button>
                </form>
            </div>
            <ul class="navbar-nav ms-auto me-0">
                <li class="nav-item me-xl-3">
                    <a class="nav-link" href="#">Why Neuly</a>
                </li>
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.organizations') }}"><i class="fad fa-building fa-fw"></i> Organizations</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.people') }}"><i class="fad fa-users fa-fw"></i> People</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.investors') }}"><i class="fad fa-hands-usd fa-fw"></i> Investors</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.locations.maps.global') }}"><i class="fad fa-map-pin fa-fw"></i> Locations</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.focus') }}"><i class="fad fa-tags fa-fw"></i> Focus</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.research') }}"><i class="fad fa-microscope fa-fw"></i> Research</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.clinicaltrials') }}"><i class="fad fa-stethoscope fa-fw"></i> Clinical Trials</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.index') }}"><i class="fad fa-chart-area fa-fw"></i> Pubco Index</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Community
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.events') }}"><i class="fad fa-calendar fa-fw"></i> Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.jobs') }}"><i class="fad fa-briefcase fa-fw"></i> Jobs</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.news') }}"><i class="fad fa-newspaper fa-fw"></i> News</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.books') }}"><i class="fad fa-book fa-fw"></i> Books</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.podcasts') }}"><i class="fad fa-podcast fa-fw"></i> Podcasts</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.courses') }}"><i class="fad fa-book-reader fa-fw"></i> Courses</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.videos') }}"><i class="fad fa-film fa-fw"></i> Videos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Treatment
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.bookable-listing.practitioners') }}"><i class="fad fa-medkit fa-fw"></i> Find a Practitioner</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.bookable-listing.practitioners') }}"><i class="fad fa-stethoscope fa-fw"></i> Find a Clinical Trial</a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item me-xl-3 d-lg-none d-xl-block">
                        <a href="" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown me-xl-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.settings') }}" title="Settings">Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.person.index') }}" title="Person">Person Listing</a></li>

                            @can('admin login')
                                <a href="/admin" class="dropdown-item">Admin</a>
                            @endcan

                            <a class="dropdown-item" href="{{ route('logout') }}" title="Logout"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-xl-3">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item me-xl-3">
                        <a class="btn btn-primary btn-cta" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-duotone fa-palette"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button type="button" class="dropdown-item" data-bs-theme-value="light">Light Mode</button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" data-bs-theme-value="dark">Dark Mode</button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item " data-bs-theme-value="auto">Auto</button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
