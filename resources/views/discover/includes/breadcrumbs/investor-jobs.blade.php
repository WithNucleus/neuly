@include('navbars.breadcrumb', [
    'items' => [
        'Investors' => route('discover.investors'),
        $investor->name  => route('discover.investors.show', $investor->slug),
        'Jobs' => false
    ]
])
