<ul class="nav nav-tabs discover-tabs">
    @if(Request::is('dashboard') OR Request::is('dashboard/*'))
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('member.dashboard') }}">
                <i class="fad fa-home"></i>
            </a>
        </li>
    @endif
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
        <a class="nav-link {{ stripos(Route::currentRouteName(), 'discover.events') !== false ? 'active' : '' }}" href="{{ route('discover.events') }}">
            <span class="icon mr-1"><i class="fad fa-calendar"></i></span>Events
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ stripos(Route::currentRouteName(), 'discover.jobs') !== false ? 'active' : '' }}" href="{{ route('discover.jobs') }}">
            <span class="icon mr-1"><i class="fad fa-briefcase"></i></span>Jobs
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ stripos(Route::currentRouteName(), 'discover.news') !== false ? 'active' : '' }}" href="{{ route('discover.news') }}">
            <span class="icon mr-1"><i class="fad fa-newspaper"></i></span>News
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.books')) active @endif " href="{{ route('discover.books') }}">
            <span class="icon mr-1"><i class="fad fa-book"></i></span>Books
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.podcasts')) active @endif " href="{{ route('discover.podcasts') }}">
            <span class="icon mr-1"><i class="fad fa-podcast"></i></span>Podcasts
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('discover.courses')) active @endif " href="{{ route('discover.courses') }}">
            <span class="icon mr-1"><i class="fad fa-book-reader"></i></span>Courses
        </a>
    </li>
    @if(Route::is('discover.videos'))
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('discover.videos') }}">
                <span class="icon mr-1"><i class="fad fa-film"></i></span>Videos
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link @if(Request::is('insights/*') OR Route::is('discover.insights')) active @endif " href="{{ route('discover.insights') }}">
            <span class="icon mr-1"><i class="fad fa-head-side-brain"></i></span>Insights
        </a>
    </li>
    @if(Route::is('search.index'))
        <li class="nav-item">
            <a href="{{ $term ? route('search.index', $term) : '#' }}" class="nav-link active">
                <span class="icon"><i class="fad fa-search"></i></span><span class="sr-only">Search</span>
            </a>
        </li>
    @endif
</ul>
