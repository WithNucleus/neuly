@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Bookmarks'  => route('member.bookmarks.index'),
        $bookmark->name => false
    ]           
])