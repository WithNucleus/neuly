<div class="d-inline-block">
    <span wire:poll.visible class="badge bg-accent me-2">{{ $user->notifications()->unseen()->count() }}</span>
</div>
