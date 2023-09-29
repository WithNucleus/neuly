<h1 class="h2">
    <a href="{{ route('member.follow-lists.index') }}" class="text-decoration-none">
        <i class="fa-sharp fa-solid fa-star text-accent"></i>
        <span>Following</span>
    </a>
</h1>
<div>
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
