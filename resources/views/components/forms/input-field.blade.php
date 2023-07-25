<div class="{{ $classes ?? 'col-12 col-md-6 col-lg-8 mb-3' }}">
    <input wire:model="{{ $id }}" id="{{ $id }}" type="{{ $type }}" class="form-control" aria-label="{{ $name }}" placeholder="{{ $placeholder ?? $name }}">
    @error($id) <div class="text-danger text-small">{{ $message }}</div> @enderror
</div>
