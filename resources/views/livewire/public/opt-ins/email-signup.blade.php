<div>
    <form wire:submit.prevent="submit" class="d-flex">
        <input wire:model.lazy="email" type="email" class="form-control" aria-label="Email Address" placeholder="Email Address">
        <button type="submit" class="btn btn-accent text-nowrap">Join For Free</button>
    </form>
    @error('email') <div class="text-danger text-small">{{ $message }}</div> @enderror
    @if($success) <div class="mt-2 text-accent fs-6">{{ $success }}</div> @endif
    @if($error) <div class="text-danger text-small">{{ $error }}</div> @endif
</div>
