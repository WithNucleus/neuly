<form wire:submit.prevent="submit">
    <div class="mb-3 fs-6 text-accent">
        {{ $entity->name }}
    </div>
    <div class="mb-3">
        <label for="list" class="fw-bold">List</label>
        <select wire:model="follow.follow_list_id" id="list" class="form-select">
            @foreach($lists as $list)
                <option value="{{ $list->id }}">{{ $list->name }}</option>
            @endforeach
        </select>
        @error('list') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="notes" class="fw-bold">Notes</label>
        <textarea wire:model="follow.notes" id="notes" class="form-control"></textarea>
        @error('notes') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <button wire:click="addNewList" class="btn btn-sm"><i class="far fa-plus"></i> Add New List</button>
        @if($addNewList)
            <div class="my-1 d-md-flex">
                <input wire:model="newListName" class="form-control me-2" aria-label="New list name" placeholder="New list name" />
                <button wire:click="saveNewList" class="btn btn-sm btn-accent rounded-0">Add</button>
            </div>
            @if($newListError)
                <div class="text-danger text-small">{{ $newListError }}</div>
            @endif
        @endif
        @if($newListSuccess)
            <div class="text-accent">{{ $newListSuccess }}</div>
        @endif
    </div>

    <div class="mb-3">
        <div>
            <strong class="d-block">Notifications:</strong>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:model="follow.email_notification" id="email_notification">
                <label class="form-check-label" for="email_notification">Email</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:model="follow.app_notification" id="app_notification">
                <label class="form-check-label" for="app_notification">Neuly</label>
            </div>
        </div>
        @error('email_notification') <div class="text-danger">{{ $message }}</div> @enderror
        @error('app_notification') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="d-flex flex-wrap align-items-center">
        <div class="me-3">
            <button type="submit" class="btn btn-primary rounded-0">Save</button>
        </div>
        @if($success)
            <div class="text-accent">{{ $success }}</div>
        @endif
        @if($error)
            <div class="text-danger text-small">{{ $error }}</div>
        @endif
    </div>
</form>
@if($isFollowed)
    <div wire:poll.visible wire:key="follow-sucess" class="mt-4 border-top pt-4">
        <button wire:click="removeFollow" class="btn btn-outline-danger rounded-0">Remove Follow</button>
    </div>
@endif
