<h1 class="h2">
    <a href="{{ route('member.follow-lists.index') }}" class="text-decoration-none">
        <i class="fa-sharp fa-solid fa-user text-accent"></i>
        <span>Neuly Person Listing</span>
    </a>
</h1>
<div class="card p-4 border-accent">
    <div class="fs-6">
        @include('members.settings._related-person')
    </div>
</div>
