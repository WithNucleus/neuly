@include('navbars.breadcrumb', [
    'items' => [
        'Dashboard' => route('member.dashboard'),
        'Notes'  => route('member.notes.index'),
        $note->title => false
    ]           
])