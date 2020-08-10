@include('navbars.breadcrumb', [
	'items' => [
		'Focus' => route('discover.focus'),
		$focus->name 	=> false
	]    		
])