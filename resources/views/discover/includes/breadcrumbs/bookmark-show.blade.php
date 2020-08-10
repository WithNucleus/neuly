@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Bookmarks'  => route('member.bookmarks.index'),
        $list->name => false
    ]           
])