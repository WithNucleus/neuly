@include('navbars.breadcrumb', [
	'items' => [
		'Jobs' 		=> route('discover.jobs'),
		$job->company->name  => route('discover.organizations.show', $job->company->slug),
		$job->job_title 	=> false
	]    		
])