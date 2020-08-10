@include('navbars.breadcrumb', [
	'items' => [
		'Events' 		=> route('discover.events'),
		$event->name 	=> false
	]    		
])