@include('navbars.breadcrumb', [
    'items' => [
        'Organizations' => route('discover.organizations'),
        $company->name  => route('discover.organizations.show', $company->slug),
        'Jobs' => false
    ]           
])