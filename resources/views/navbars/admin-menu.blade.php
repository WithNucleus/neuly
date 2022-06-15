@can('admin login')
	<div id="admin-menu-button" class="js-nucleus-nav-tiles">
	    <button class="btn btn-dark p-2" id="toggle-admin-menu" tabindex="1" data-toggle="tooltip" data-placement="right" title="Neuly Admin">
	        <i class="fad fa-cogs fa-lg text-tertiary"></i> <span class="sr-only">Admin Menu</span></button>
	</div>

	<div id="admin-backdrop" style="display: none;"></div>
	<div id="admin-menu" class="rounded shadow-sm" style="display: none;">

		<div class="row">
			<div class="col-12 col-md-6">
				<p class="font-size-large">Hi {{ Auth::user()->name }}!</p>

				<?php
					if (Route::is('discover.organizations')) {

						$this_type = 'Organizations';
						$this_view = 'index';
						$this_route = 'company.index';

					} elseif (Route::is('discover.organizations.show')) {

						$this_type = 'Organizations';
						$this_view = 'show';
						$this_name = $company->name;
						$this_route = 'company.edit';
						$this_id = $company->id;

					} elseif (Route::is('discover.people')) {

						$this_type = 'People';
						$this_view = 'index';
						$this_route = 'person.index';

					} elseif (Route::is('discover.people.show')) {

						$this_type = 'People';
						$this_view = 'show';
						$this_name = $person->name;
						$this_route = 'person.edit';
						$this_id = $person->id;

					} elseif (Route::is('discover.research')) {

						$this_type = 'Research';
						$this_view = 'index';
						$this_route = 'research.index';

					} elseif (Route::is('discover.research.show')) {

						$this_type = 'Research';
						$this_view = 'show';
						$this_name = $research->name;
						$this_route = 'research.edit';
						$this_id = $research->id;

					} elseif (Route::is('discover.locations')) {

						$this_type = 'Locations';
						$this_view = 'index';
						$this_route = 'location.index';

					} elseif (Route::is('discover.locations.show')) {

						$this_type = 'Locations';
						$this_view = 'show';
						$this_name = $location->name;
						$this_route = 'location.edit';
						$this_id = $location->id;

					} elseif (Route::is('discover.focus')) {

						$this_type = 'Focus';
						$this_view = 'index';
						$this_route = 'focus.index';

					} elseif (Route::is('discover.focus.show')) {

						$this_type = 'Focus';
						$this_view = 'show';
						$this_name = $focus->name;
						$this_route = 'focus.edit';
						$this_id = $focus->id;

					} elseif (Route::is('discover.events') OR Route::is('discover.events.past')) {

						$this_type = 'Events';
						$this_view = 'index';
						$this_route = 'event.index';

					} elseif (Route::is('discover.events.show')) {

						$this_type = 'Events';
						$this_view = 'show';
						$this_name = $event->name;
						$this_route = 'event.edit';
						$this_id = $event->id;

					} elseif (Route::is('discover.jobs')) {

						$this_type = 'Jobs';
						$this_view = 'index';
						$this_route = 'job.index';

					} elseif (Route::is('discover.jobs.show')) {

						$this_type = 'Jobs';
						$this_view = 'show';
						$this_name = $job->job_title;
						$this_route = 'job.edit';
						$this_id = $job->id;

					} elseif (Route::is('discover.investors')) {

						$this_type = 'Investors';
						$this_view = 'index';
						$this_route = 'job.index';

					} elseif (Route::is('discover.investors.show')) {

						$this_type = 'Investors';
						$this_view = 'show';
						$this_name = $investor->name;
						$this_route = 'investor.edit';
						$this_id = $investor->id;

					} elseif (Route::is('discover.clinicaltrials')) {

						$this_type = 'Clinical Trials';
						$this_view = 'index';
						$this_route = 'clinicaltrial.index';

					} elseif (Route::is('discover.clinicaltrials.show')) {

						$this_type = 'Clinical Trials';
						$this_view = 'show';
						$this_name = $clinicaltrial->title;
						$this_route = 'clinicaltrial.edit';
						$this_id = $clinicaltrial->id;

					} else {
						$this_type = '';
						$this_view = '';
						$this_name = '';
					}
				?>

				@if ($this_type != '')
						<p class="mb-1">You are viewing:</p>

						<p class="mb-2 font-weight-bold text-uppercase text-tertiary">
							{{ ($this_type) ? $this_type : '' }}
						</p>
						@if ($this_view == 'show')
							<p>{{ ($this_name) ? $this_name : '' }}</p>
							@if ($this_route && $this_id)
								<p><a href="{{ route($this_route, $this_id) }}" class="btn btn-sm btn-primary"><i class="fad fa-pencil"></i> EDIT THIS</a></p>
							@endif
						@elseif ($this_view == 'index')
							@if ($this_route)
								<p><a href="{{ route($this_route) }}" class="btn btn-sm btn-primary">ADMIN <i class="fad fa-archive"></i></a></p>
							@endif
						@endif


				@endif
			</div>

			<div class="col-12 col-md-6">
				<p class="title mb-1 font-weight-bold text-uppercase text-tertiary pr-4">Admin Links</p>

				<div class="overflow-scroll">
					<ul class="admin-menu-links plain-list mb-0">

					    @include('navbars.admin-menu-backpack')
					</ul>
				</div>
			</div>
		</div>
	</div>
@endcan
