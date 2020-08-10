@include('navbars.breadcrumb', [
	'items' => [
		'Research' 			=> route('discover.research'),
		$research->name 	=> false
	]    		
])