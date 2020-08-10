<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('dashboard') }}">
		<i class="fad fa-lg fa-house"></i> <span class="sr-only">Admin Home</span>
	</a>
</li>

@can('edit companies')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('company') }}'>
			<i class="fad fa-lg fa-building"></i> <span class="sr-only">Organizations</span>
		</a>
	</li>
@endcan

@can('edit people')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('person') }}'>
			<i class="fad fa-lg fa-user-circle"></i> <span class="sr-only">People</span>
		</a>
	</li>
@endcan

@can('edit investors')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('investor') }}'>
			<i class="fad fa-lg fa-hands-usd"></i> <span class="sr-only">Investors</span>
		</a>
	</li>
@endcan

@can('edit focus categories')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('focus') }}'>
			<i class="fad fa-lg fa-flask"></i> <span class="sr-only">Focus</span>
		</a>
	</li>
@endcan

@can('edit locations')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('location') }}'>
			<i class="fad fa-lg fa-map"></i> <span class="sr-only">Locations</span>
		</a>
	</li>
@endcan

@can('edit jobs')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('job') }}'>
			<i class="fad fa-lg fa-briefcase"></i> <span class="sr-only">Jobs</span>
		</a>
	</li>
@endcan

@can('edit research')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('research') }}'>
			<i class="fad fa-lg fa-microscope"></i> <span class="sr-only">Research</span>
		</a>
	</li>
@endcan

@can('edit events')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('event') }}'>
			<i class="fad fa-lg fa-calendar"></i> <span class="sr-only">Events</span>
		</a>
	</li>
@endcan

@can('edit news articles')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('newsarticle') }}'>
			<i class="fad fa-lg fa-newspaper"></i> <span class="sr-only">News Articles</span>
		</a>
	</li>
@endcan

@can('edit clinical trials')
	<li class="nav-item">
		<a class="nav-link" href="{{ backpack_url('clinicaltrial') }}">
			<i class="fad fa-lg fa-stethoscope"></i> <span class="sr-only">Clinical Trials</span>
		</a>
	</li>
@endcan

@can('view backups')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('backup') }}'>
			<i class="fad fa-lg fa-hdd"></i> <span class="sr-only">Backups</span>
		</a>
	</li>
@endcan

@can('view logs')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('log') }}'>
			<i class="fad fa-lg fa-bug"></i> <span class="sr-only">Logs</span>
		</a>
	</li>
@endcan

@can('edit users')
	<li class="nav-item">
		<a class="nav-link" href="{{ backpack_url('user') }}">
			<i class="fad fa-lg fa-users"></i> <span class="sr-only">Users</span>
		</a>
	</li>
@endcan

@can('edit content')
	<li class='nav-item'>
		<a class='nav-link' href='{{ backpack_url('page') }}'>
			<i class="fad fa-lg fa-pen-fancy"></i> <span class="sr-only">Pages</span>
		</a>
	</li>
@endcan
