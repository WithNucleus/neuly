@include('navbars.breadcrumb', [
    'items' => [
        $member->name . ' ' . $member->last_name => false,
        $note->title => false
    ]           
])