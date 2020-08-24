@include('navbars.breadcrumb', [
    'items' => [
        $member->name . ' ' . $member->last_name => false,
        $list->name => false
    ]           
])