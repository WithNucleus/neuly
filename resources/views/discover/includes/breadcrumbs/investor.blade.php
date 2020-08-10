@include('navbars.breadcrumb', [
	'items' => [
		'Investors' 		=> route('discover.investors'),
		$investor->name 	=> false
	]    		
])