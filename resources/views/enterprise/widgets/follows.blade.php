<p class="lead mb-1">Lists</p>
@include('members.data.follow-lists', ['lists' => $followLists, 'show_more' => true, 'shadow' => false])

<p class="lead mt-4 mb-1">Recently Added</p>
@include('members.data.follows', [
    'show_more' => true,
    'shadow' => false,
    'show_action_items' => false,
    'show_list_name' => false
])
