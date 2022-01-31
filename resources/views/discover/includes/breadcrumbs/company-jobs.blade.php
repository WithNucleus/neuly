@include('navbars.breadcrumb', [
    'items' => [
        'Organizations' => route('discover.organizations'),
        $owner->name  => route('discover.organizations.show', $owner->slug),
        'Jobs' => false
    ]
])
