@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Follow Lists'  => route('member.follow-lists.index'),
        $list->name => false
    ]
])
