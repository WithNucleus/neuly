@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Following'  => false,
    ]           
])