<div wire:key="model-{{ $model->id }}">
    Model ID: {{ $model->id }}
    <div>
        <div class="d-flex align-items-center">
            <select wire:model="selectedTag" id="tag" class="form-control me-2 {{ ($error) ? 'is-invalid' : '' }} {{ ($success) ? 'is-valid' : '' }}" aria-label="Assign Focus" style="width: 160px">
                <option></option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <button wire:click="saveTag" class="btn btn-sm btn-primary flex-shrink-0">Set Focus</button>
        </div>
    </div>
</div>
