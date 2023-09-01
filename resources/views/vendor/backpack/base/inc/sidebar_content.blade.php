    <!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('dashboard') }}">
		<i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
	</a>
</li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

@can('edit companies')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-building"></i> Organizations</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('company') }}'>Organizations List</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('companyvaluation') }}'>Valuations</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('companybranch') }}'>Branches</a>
            </li>
            @can('import')
                <li class="nav-item">
{{--                    <a class="nav-link" href="{{ route('admin.import.company.serpapi.index') }}">--}}
{{--                        <span>Import Details</span>--}}
{{--                    </a>--}}
                    <span class="nav-link">
                        <span>Import Details <span class="badge">disabled</span></span>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.import.company.serpapi-data.index') }}">
                        <span>Import Results</span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-shopping-basket"></i> Bookable Listings</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('bookable-listing') }}'>Listings</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('bookable-listing-request') }}'>Requests</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('directory') }}'>
                    <i class='nav-icon la la-address-card'></i> Directories</a>
            </li>
        </ul>
    </li>
@endcan

@can('edit people')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user"></i> People</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('person') }}'>People List</a>
            </li>
            @can('import')
            <li class='nav-item'>
                <a class='nav-link' href='{{ route('admin.import.people.index') }}'>Import People</a>
            </li>
            @endcan
        </ul>
    </li>
@endcan

@can('edit investors')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('investor') }}'>
			<i class='nav-icon la la-wallet'></i> Investors
		</a>
	</li>
@endcan

@can('edit focus categories')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('focus') }}'>
			<i class='nav-icon la la-tag'></i> Focus Categories
		</a>
	</li>
@endcan

@can('edit locations')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('location') }}'>
			<i class='nav-icon la la-campground'></i> Locations
		</a>
	</li>
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('location-geocoding') }}'>
            <i class='nav-icon la la-search-location'></i> Locations Geocoding
        </a>
    </li>
@endcan

@can('edit jobs')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('job') }}'>
			<i class='nav-icon la la-thumbtack'></i> Jobs
		</a>
	</li>
@endcan

@can('view job applications')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('jobapplication') }}'>
			<i class='nav-icon la la-briefcase'></i> Job Applications
		</a>
	</li>
@endcan

@can('edit research')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('research') }}'>
			<i class='nav-icon la la-school'></i> Research
		</a>
	</li>
@endcan

@can('edit events')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-calendar"></i> Events</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('event') }}'>Events List</a>
            </li>
            @can('edit event types')
                <li class='nav-item'>
                    <a class='nav-link' href='{{ backpack_url('eventtype') }}'>Event Types</a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('edit clinical trials')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-stethoscope"></i> Clinical Trials</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('clinicaltrial') }}'>Clinical Trials List</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('clinicaltrialphase') }}'>Phases</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('ct_condition') }}'>Conditions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('ct_intervention') }}'>Interventions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('ct_outcome_measure') }}'>Outcome Measures</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('ct_study_design') }}'>Study Designs</a>
            </li>
            @can('import')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.import.clinicaltrial.parsing.index') }}">
                        <span>Import Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.import.clinicaltrial.parsing-results.index') }}">
                        <span>Import Results</span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('import')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cloud-upload-alt"></i> Import</a>
		<ul class="nav-dropdown-items">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('import.clinicaltrials') }}">
					<i class="nav-icon la la-stethoscope"></i> <span>Clinical Trials</span>
				</a>
			</li>
            <li class="nav-item">
                <a class='nav-link' href='{{ route('import.related-entities.index') }}'>
                    <i class='nav-icon la la-link'></i> Related Entities
                </a>
            </li>
			<li class="nav-item">
				<a class='nav-link' href='{{ route('import.research') }}'>
					<i class='nav-icon la la-school'></i> Research
				</a>
			</li>
            <li class="nav-item">
                <a class='nav-link' href='{{ route('import.batch-images-upload.index') }}'>
                    <i class='nav-icon la la-images'></i> Image Upload
                </a>
            </li>
            <li class="nav-item">
                <a class='nav-link' href='{{ route('import.settings.index') }}'>
                    <i class='nav-icon la la-cog'></i> Import Settings
                </a>
            </li>
		</ul>
	</li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-brain"></i> Data &amp; Media</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'>
                <a class='nav-link' href='{{ route('admin.media-dashboard') }}'>
                    <i class='nav-icon la la-list-alt'></i> Dashboard
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('datafeed') }}'>
                    <i class='nav-icon la la-rss'></i> Data Feeds
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('media-item') }}'>
                    <i class='nav-icon la la-photo-video'></i> Media Items
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('course') }}'>
                    <i class='nav-icon la la-book-reader'></i> Courses
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('patent') }}'>
                    <i class='nav-icon la la-lightbulb'></i> Patents
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{{ route('admin.metrics.tiles') }}?range=last-30-days'>
                    <i class='nav-icon la la-chart-line'></i> Metrics
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('manage listing requests')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('listingrequest') }}'>
            <i class='nav-icon la la-business-time'></i> Listing Requests
            @if($countListingRequests)
                <span class="badge badge-default">{{ $countListingRequests }}</span>
            @endif
        </a>
    </li>
@endcan

@can('manage insight requests')
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('insightRequest') }}'>
        <i class='nav-icon la la-question'></i> Insight requests
        @if($countInsightRequests)
            <span class="badge badge-default">{{ $countInsightRequests }}</span>
        @endif
    </a>
</li>
@endcan

@can('manage job reports')
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('jobreportentries') }}'>
        <i class='nav-icon la la-business-time'></i> Job Report Entries
        @if($countJobReports)
            <span class="badge badge-default">{{ $countJobReports }}</span>
        @endif
    </a>
</li>
@endcan

@can('manage entity merge')
    <li class='nav-item'>
        <a class='nav-link' href='{{ route('admin.entityMerge') }}'>
            <i class='nav-icon la la-sync'></i> Entity Merge
        </a>
    </li>
@endcan

@can('edit companies')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('entitycontent') }}'>
            <i class='nav-icon la la-file-alt'></i> Entity Content
        </a>
    </li>
@endcan

@can('view backups')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('backup') }}'>
			<i class='nav-icon la la-hdd-o'></i> Backups
		</a>
	</li>
@endcan

@can('view logs')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-archive"></i> Logs</a>
        <ul class="nav-dropdown-items">
            <li class=nav-item">
                <a class="nav-link" href="{{ backpack_url('log') }}">
                    <i class="nav-icon la la-terminal"></i> Laravel Log
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ backpack_url('log-embed') }}">
                    <i class="nav-icon la la-window-maximize"></i> Embed Log
                </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('searchlog') }}'>
                    <i class='nav-icon la la-search'></i> Search Log
                </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='{{ backpack_url('activity-log') }}'>
                    <i class='nav-icon la la-running'></i> Activity Log
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('manage redirects')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('redirect') }}'>
            <i class='nav-icon la la-step-forward'></i> <span>Redirects</span>
        </a>
    </li>
@endcan

@can('edit users')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i
                        class="nav-icon la la-user"></i> <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i
                        class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i
                        class="nav-icon la la-lock"></i> <span>Permissions</span></a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('api-user') }}'><i
                        class='nav-icon la la-exchange-alt'></i> API Users</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('oauth-clients') }}'>
                    <i class='nav-icon la la-key'></i> OAuth Clients</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('oauth-access-token') }}'>
                    <i class='nav-icon la la-key'></i> OAuth Access Tokens</a>
            </li>
        </ul>
    </li>
@endcan

@can('edit content')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('page') }}'>
			<i class='nav-icon la la-pen-fancy'></i> <span>Pages</span>
		</a>
	</li>
@endcan

@can('edit feedback')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('feedback') }}'>
            <i class='nav-icon la la-comment'></i> <span>Feedback</span>
        </a>
    </li>
@endcan

@can('edit person claims')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('person-claim') }}'>
            <i class="nav-icon la la-user-tag"></i> <span>Person Claims</span>
        </a>
    </li>
@endcan

@can('manage ranked lists')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('rankedList') }}'>
            <i class='nav-icon la la-list-ol'></i> Ranked Lists
        </a>
    </li>
@endcan

@can('manage navigation tiles')
    <li class='nav-item'>
        <a class='nav-link' href='{{ route('adminx.nav-tiles.index') }}'>
            <i class='nav-icon la la-compass'></i> Navigation Tiles
        </a>
    </li>
@endcan

@can('nucleus tools')
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('embeddable-search-widget') }}'>
        <i class='nav-icon la la-search'></i> Embeddable search
    </a>
</li>
@endcan

<style>
    pre {
        white-space: pre-wrap;       /* css-3 */
        white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        word-wrap: break-word;       /* Internet Explorer 5.5+ */
    }
</style>
