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
            <div class="ms-lg-3 my-3 my-lg-0 flex-grow-1 max-width-780 me-lg-5">
                <div id="search-neuly"></div>
            </div>
            <ul class="navbar-nav ms-auto me-0 align-items-lg-center">
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Research
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.organizations') }}"><i class="fa-sharp fa-solid fa-building fa-fw"></i> Organizations</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.people') }}"><i class="fa-sharp fa-solid fa-users fa-fw"></i> People</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.investors') }}"><i class="fa-sharp fa-solid fa-hands-usd fa-fw"></i> Investors</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.jobs') }}"><i class="fa-sharp fa-solid fa-briefcase fa-fw"></i> Jobs</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.locations.maps.global') }}"><i class="fa-sharp fa-solid fa-map-pin fa-fw"></i> Locations</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.focus') }}"><i class="fa-sharp fa-solid fa-tags fa-fw"></i> Focus</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.research') }}"><i class="fa-sharp fa-solid fa-microscope fa-fw"></i> Research</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.clinicaltrials') }}"><i class="fa-sharp fa-solid fa-stethoscope fa-fw"></i> Clinical Trials</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.index') }}"><i class="fa-sharp fa-solid fa-chart-area fa-fw"></i> Stock Market</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        EDU
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.courses') }}"><i class="fa-sharp fa-solid fa-book-reader fa-fw"></i> Courses</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.podcasts') }}"><i class="fa-sharp fa-solid fa-podcast fa-fw"></i> Podcasts</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.books') }}"><i class="fa-sharp fa-solid fa-book fa-fw"></i> Books</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.articles') }}"><i class="fa-sharp fa-solid fa-memo fa-fw"></i> Articles</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.news') }}"><i class="fa-sharp fa-solid fa-newspaper fa-fw"></i> News</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.events') }}"><i class="fa-sharp fa-solid fa-calendar fa-fw"></i> Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.videos') }}"><i class="fa-sharp fa-solid fa-film fa-fw"></i> Videos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3">
                    <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Care
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('discover.bookable-listing.practitioners') }}"><i class="fa-sharp fa-solid fa-medkit fa-fw"></i> Find a Practitioner</a></li>
                        <li><a class="dropdown-item" href="{{ route('discover.clinicaltrials.recruiting') }}"><i class="fa-sharp fa-solid fa-stethoscope fa-fw"></i> Find a Clinical Trial</a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item me-xl-3 d-lg-none d-xl-block">
                        @can('enterprise demo')
                            <a href="{{ route('enterprise.dashboard') }}" class="nav-link text-uppercase">Dashboard</a>
                        @else
                            <a href="{{ route('member.dashboard') }}" class="nav-link text-uppercase">Dashboard</a>
                        @endcan
                    </li>
                    <li class="nav-item dropdown me-xl-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-sharp fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.settings') }}" title="Settings">Settings</a></li>

                            @can('admin login')
                                <a href="/admin" class="dropdown-item">Admin</a>
                            @endcan
                            @can('import')
                                <a href="/adminx" class="dropdown-item">Admin</a>
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
                        <a class="btn btn-accent text-white btn-cta" href="{{ route('register') }}">Register</a>
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
