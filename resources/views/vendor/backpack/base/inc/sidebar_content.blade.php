<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('dashboard') }}">
		<i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
	</a>
</li>

@can('edit companies')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('company') }}'>
			<i class='nav-icon la la-building'></i> Organizations
		</a>
	</li>
@endcan

@can('edit people')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('person') }}'>
			<i class='nav-icon la la-user'></i> People
		</a>
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
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('event') }}'>
			<i class='nav-icon la la-calendar'></i> Events
		</a>
	</li>
@endcan

@can('edit event types')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('eventtype') }}'>
			<i class='nav-icon la la-list'></i> Event Types
		</a>
	</li>
@endcan

@can('edit news articles')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('newsarticle') }}'>
			<i class='nav-icon la la-newspaper'></i> News Articles
		</a>
	</li>
@endcan

@can('edit clinical trials')
	<li class="nav-item">
		<a class="nav-link" href="{{ backpack_url('clinicaltrial') }}">
			<i class="nav-icon la la-stethoscope"></i> <span>Clinical Trials</span>
		</a>
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
                <a class='nav-link' href='{{ route('import.settings.index') }}'>
                    <i class='nav-icon la la-cog'></i> Import Settings
                </a>
            </li>
		</ul>
	</li>
@endcan

@can('manage listing requests')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('listingrequest') }}'>
            <i class='nav-icon la la-business-time'></i> Listing Requests
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

@can('view backups')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('backup') }}'>
			<i class='nav-icon la la-hdd-o'></i> Backups
		</a>
	</li>
@endcan

@can('view logs')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('log') }}'>
			<i class='nav-icon la la-terminal'></i> Logs
		</a>
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
		  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
		  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
		  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
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
