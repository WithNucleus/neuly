@include('navbars.breadcrumb', [
	'items' => [
		'Locations' 		=> route('discover.locations.maps.global'),
		$location->name 	=> false
	]
])
