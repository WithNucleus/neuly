<div>
    @if($showModal)
        @if ($buttonLabel)
            <button type="button" class="btn rounded-0 btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#follow-entity-modal-{{ $entity->id }}">
                {{ $buttonLabel }}
            </button>
        @else
            <button type="button" class="btn rounded-0 fs-5 text-accent btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#follow-entity-modal-{{ $entity->id }}">
                <i class="fa-sharp {{ ($isFollowed) ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
            </button>
        @endif
        <div wire:ignore.self class="modal fade" id="follow-entity-modal-{{ $entity->id }}" tabindex="-1" aria-labelledby="follow-entity-modal-{{ $entity->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">1
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="follow-entity-modal-{{ $entity->id }}-label">Follow Settings</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        @include('members.follow.livewire-form')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            @include('members.follow.livewire-form')
        </div>
    @endif
</div>
