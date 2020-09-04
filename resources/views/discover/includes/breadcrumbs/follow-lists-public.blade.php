@include('navbars.breadcrumb', [
    'items' => [
        $user->name . ' ' . $user->last_name => false,
        $list->name => false
    ]
])
