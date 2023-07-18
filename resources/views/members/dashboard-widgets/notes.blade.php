<h1 class="h2">
    <a href="{{ route('member.notes.index') }}" class="text-decoration-none">
        <i class="fa-sharp fa-solid fa-file-edit text-accent"></i>
        <span>Notes</span>
    </a>
</h1>
<div>
    <p class="lead mb-1">Recent Notes</p>
    @include('members.data.notes', ['shadow' => false, 'show_more' => true])
</div>
