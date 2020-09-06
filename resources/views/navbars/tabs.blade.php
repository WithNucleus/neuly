<ul class="nav nav-tabs discover-tabs">

    <li class="nav-item">
        <a class="nav-link @if(Request::is('dashboard') OR Request::is('dashboard/*')) active @endif "href="{{ route('member.dashboard') }}">
            <span class="icon mr-1"><i class="fad fa-home"></i></span>Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.organizations') OR Route::is('discover.organizations.show')) active @endif" href="{{ route('discover.organizations') }}">
            <span class="icon mr-1"><i class="fad fa-building"></i></span>Organizations
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.people') OR Route::is('discover.people.show')) active @endif" href="{{ route('discover.people') }}">
            <span class="icon mr-1"><i class="fad fa-users"></i></span>People
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.investors') OR Route::is('discover.investors.show')) active @endif "href="{{ route('discover.investors') }}">
            <span class="icon mr-1"><i class="fad fa-hands-usd"></i></span>Investors
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.locations') OR Route::is('discover.locations.show')) active @endif "href="{{ route('discover.locations') }}">
            <span class="icon mr-1"><i class="fad fa-map-pin"></i></span>Locations
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.focus') OR Route::is('discover.focus.show')) active @endif "href="{{ route('discover.focus') }}">
            <span class="icon mr-1"><i class="fad fa-tags"></i></span>Focus
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.research') OR Route::is('discover.research.show')) active @endif "href="/research">
            <span class="icon mr-1"><i class="fad fa-microscope"></i></span>Research
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.clinicaltrials') OR Route::is('discover.clinicaltrials.show')) active @endif "href="{{ route('discover.clinicaltrials') }}">
            <span class="icon mr-1"><i class="fad fa-stethoscope"></i></span>Clinical Trials
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('discover.index') }}" class="nav-link @if(Route::is('discover.index')) active @endif">
            <span class="icon mr-1"><i class="fad fa-chart-area"></i></span>Pubco Index
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.events') OR Route::is('discover.events.show') OR Route::is('discover.events.past')) active @endif " href="{{ route('discover.events') }}">
            <span class="icon mr-1"><i class="fad fa-calendar"></i></span>Events
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.jobs') OR Route::is('discover.jobs.show')) active @endif "href="{{ route('discover.jobs') }}">
            <span class="icon mr-1"><i class="fad fa-briefcase"></i></span>Jobs
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.insights')) active @endif "href="{{ route('discover.insights') }}">
            <span class="icon mr-1"><i class="fad fa-head-side-brain"></i></span>Insights
        </a>
    </li>

    @if(Route::is('search.term'))
        <li class="nav-item">
            <a href="{{ $term ? route('search.term', $term) : '#' }}" class="nav-link active">
                <span class="icon"><i class="fad fa-search"></i></span><span class="sr-only">Search</span>
            </a>
        </li>
    @endif

</ul>
