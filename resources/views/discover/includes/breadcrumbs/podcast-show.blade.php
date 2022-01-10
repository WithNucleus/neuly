@include('navbars.breadcrumb', [
    'items' => [
        'Podcasts' => route('discover.podcasts'),
        $feed->name => false,
    ]
])
