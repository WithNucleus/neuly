@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Notes'  => route('member.notes.index'),
        'Add Note' => false
    ]           
])