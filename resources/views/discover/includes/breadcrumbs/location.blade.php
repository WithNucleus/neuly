@include('navbars.breadcrumb', [
	'items' => [
		'Locations' 		=> route('discover.locations'),
		$location->name 	=> false
	]    		
])