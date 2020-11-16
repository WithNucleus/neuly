<form class="discover-tabs navbar-tabs-bg w-100 pb-4 pl-4 pr-4">
    <div class="d-flex align-items-baseline justify-content-center flex-wrap">
        <label for="discover" class="text-light mr-2 text-shadow lead">DISCOVER</label>
        <select class="custom-select discover shadow-sm" name="discover" style="max-width: 200px;">
            <option value="dashboard"
                @if(Request::is('dashboard') OR Request::is('dashboard/*'))
                    selected
                @endif
            >Dashboard</option>
            <option value="organizations"
                @if(Route::is('discover.organizations') OR Route::is('discover.organizations.show'))
                    selected
                @endif
            >Organizations</option>
            <option value="people"
                @if(Route::is('discover.people') OR Route::is('discover.people.show'))
                    selected
                @endif
            >People</option>
            <option value="investors"
                @if(Route::is('discover.investors') OR Route::is('discover.investors.show'))
                    selected
                @endif
            >Investors</option>
            <option value="locations"
                @if(Route::is('discover.locations') OR Route::is('discover.locations.*'))
                    selected
                @endif
            >Locations</option>
            <option value="focus"
                @if(Route::is('discover.focus') OR Route::is('discover.focus.show'))
                    selected
                @endif
            >Focus</option>
            <option value="research"
                @if(Route::is('discover.research') OR Route::is('discover.research.show'))
                    selected
                @endif
            >Research</option>
            <option value="clinicaltrials"
                @if(Route::is('discover.clinicaltrials') OR Route::is('discover.clinicaltrials.show'))
                    selected
                @endif
            >Clinical Trials</option>
            <option value="index"
                @if(Route::is('discover.index'))
                    selected
                @endif
            >Pubco Index</option>
            <option value="events"
                @if(Route::is('discover.events') OR Route::is('discover.events.show') OR Route::is('discover.events.past'))
                    selected
                @endif
            >Events</option>
            <option value="jobs"
                @if(Route::is('discover.jobs') OR Route::is('discover.jobs.show'))
                    selected
                @endif
            >Jobs</option>
            <option value="insights"
                @if(Route::is('discover.insights') OR Request::is('insights/*'))
                    selected
                @endif
            >Insights</option>
            @if(Route::is('search.index'))
                <option value="search" selected>Search</option>
            @endif
            <option value="home">Home</option>
        </select>
    </div>
</form>
<script src="{{ asset('js/discovertabs.js') }}"></script>
