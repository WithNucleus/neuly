<div>
    <div class="d-flex">
        <input wire:model="email" type="email" class="form-control" aria-label="Email Address" placeholder="Email Address">
        <button wire:click="save" class="btn btn-accent text-nowrap">Join For Free</button>
    </div>
    @error('email') <div class="text-danger text-small">{{ $message }}</div> @enderror
    @if($success) <div class="text-accent text-small">{{ $success }}</div> @endif
</div>
