<nav id="primary-nav" class="navbar navbar-dark fixed-top bg-dark flex-xl-nowrap shadow navbar-expand-lg">
    <a class="navbar-brand ml-3" href="/"><img src="{{ asset('images/neuly-logo-dark.png') }}" alt="Neuly"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @auth
        <div class="ml-3 mr-auto d-none d-lg-block d-xl-block d-xxl-block">
            <button class="btn global-search-button global-search-trigger ml-2 my-2 my-sm-0" title="Search Neuly" data-toggle="modal" data-target="#searchModal"><i class="far fa-search"></i></button>
        </div>
        @endauth
        <div class="ml-3 mr-auto d-lg-none">
            <form class="global-search-form form-inline mt-3 mt-lg-0" method="post" action="{{ route('search') }}">
                @csrf
                <input class="form-control global-search-input search-field js-global-search-input" name="search" type="search" placeholder="Discover organizations, people, research..." aria-label="Search">
                <button class="btn global-search-button ml-2 my-2 my-sm-0" type="submit" title="Search Neuly"><i class="far fa-search"></i></button>
            </form>
        </div>

        <ul class="navbar-nav ml-auto mr-0">

            <li class="nav-item dropdown">
                <a id="navbarDropdownExplore" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Explore
                </a>

                <div class="dropdown-menu dropdown-menu-anchor-right" aria-labelledby="navbarDropdownExplore">
                    <a class="dropdown-item" href="{{ route('discover.organizations') }}"><i class="fad fa-building fa-fw"></i> Organizations</a>
                    <a class="dropdown-item" href="{{ route('discover.people') }}"><i class="fad fa-users fa-fw"></i> People</a>
                    <a class="dropdown-item" href="{{ route('discover.research') }}"><i class="fad fa-microscope fa-fw"></i> Research</a>
                    <a class="dropdown-item" href="{{ route('discover.locations.maps.global') }}"><i class="fad fa-map-pin fa-fw"></i> Locations</a>
                    <a class="dropdown-item" href="{{ route('discover.focus') }}"><i class="fad fa-tags fa-fw"></i> Focus</a>
                    <a class="dropdown-item" href="{{ route('discover.events') }}"><i class="fad fa-calendar fa-fw"></i> Events</a>
                    <a class="dropdown-item" href="{{ route('discover.jobs') }}"><i class="fad fa-briefcase fa-fw"></i> Jobs</a>
                    <a class="dropdown-item" href="{{ route('discover.clinicaltrials') }}"><i class="fad fa-stethoscope fa-fw"></i> Clinical Trials</a>
                    <a class="dropdown-item" href="{{ route('discover.index') }}"><i class="fad fa-chart-area fa-fw"></i> Pubco Index</a>
                    <a class="dropdown-item" href="{{ route('discover.investors') }}"><i class="fad fa-hands-usd fa-fw"></i> Investors</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a id="navbarDropdownExplore" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Insights
                </a>

                <div class="dropdown-menu dropdown-menu-anchor-right" aria-labelledby="navbarDropdownExplore">
                    <a class="dropdown-item" href="{{ route('discover.insights') }}"><i class="fad fa-head-side-brain fa-fw"></i> Neuly Insights</a>
                    <a class="dropdown-item" href="{{ route('insights.clinicaltrials.pipeline') }}"><i class="fad fa-stream fa-fw"></i> Clinical Trial Tracker</a>
                    <a class="dropdown-item" href="{{ route('insights.investment-funds') }}"><i class="fad fa-chart-network fa-fw"></i> Investment Funds</a>
                    <a class="dropdown-item" href="{{ route('discover.insights.request') }}"><i class="fad fa-bullhorn fa-fw"></i> Request Insight</a>
                </div>
            </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link register" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle nav-user-dropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="nav-user-name">{{ Auth::user()->name }}</span> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-anchor-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('user.settings') }}" title="Settings">Settings</a>
                        <a class="dropdown-item" href="{{ route('user.person.index') }}" title="Person">Person Listing</a>

                        @can('admin login')
                            <a href="/admin" class="dropdown-item">Admin</a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('logout') }}" title="Logout"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.notifications.index') }}" class="nav-link">
                        <i class="fad fa-bell"></i> <span class="badge notification-badge badge-pill badge-info"></span>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
