<h1 class="h2">
    <a href="{{ route('member.notes.index') }}" class="text-dark"><i class="fad fa-file-edit text-secondary mr-2"></i>Notes</a>
</h1>
<div class="p-4 bg-white shadow-sm">
    <p class="lead mb-1">Recent Notes</p>
    @include('members.data.notes', ['shadow' => false, 'show_more' => true])
</div>
