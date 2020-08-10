@include('navbars.breadcrumb', [
    'items' => [
        'Organizations' => route('discover.organizations'),
        $company->name  => route('discover.organizations.show', $company->slug),
        'Events' => false
    ]           
])