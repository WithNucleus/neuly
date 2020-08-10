@include('navbars.breadcrumb', [
    'items' => [
        'Organizations' => route('discover.organizations'),
        $company->name  => false
    ]           
])