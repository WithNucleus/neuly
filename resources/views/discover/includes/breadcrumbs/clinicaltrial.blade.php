@include('navbars.breadcrumb', [
	'items' => [
		'Clinical Trials' 	=> route('discover.clinicaltrials'),
		$clinicaltrial->title 	=> false
	]    		
])