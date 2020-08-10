@include('navbars.breadcrumb', [
	'items' => [
		'People' 		=> route('discover.people'),
		$person->name 	=> false
	]    		
])