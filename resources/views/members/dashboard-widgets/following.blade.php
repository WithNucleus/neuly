<h1 class="h2">
    <a href="{{ route('member.follow-lists.index') }}" class="text-dark"><i class="fad fa-star text-secondary mr-2"></i>Following</a>
</h1>
<div class="p-4 bg-white shadow-sm">
    <p class="lead mb-1">Lists</p>
    @include('members.data.follow-lists', ['lists' => $followLists, 'show_more' => true, 'shadow' => false])

    <p class="lead mt-4 mb-1">Recently Added</p>
    @include('members.data.follows', [
        'show_more' => true,
        'shadow' => false,
        'show_action_items' => false,
        'show_list_name' => false
    ])
</div>
