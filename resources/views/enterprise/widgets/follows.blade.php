<div>
    <p class="lead mb-1 text-body">Lists</p>
    @include('members.data.follow-lists', ['lists' => $followLists, 'show_more' => true, 'shadow' => false])

    <p class="lead mt-4 mb-1 text-body">Recently Added</p>
    @include('members.data.follows', [
        'show_more' => true,
        'shadow' => false,
        'show_action_items' => false,
        'show_list_name' => false
    ])
</div>
