@include('navbars.breadcrumb', [
    'items' => [
        'Investors' => route('discover.investors'),
        $owner->name  => route('discover.investors.show', $owner->slug),
        'Jobs' => false
    ]
])
