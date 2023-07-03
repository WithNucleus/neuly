<div>
    @foreach ($options as $key => $option)
        <div class="form-check {{ $class }}">
            <input wire:model="{{ $wireModel }}" class="form-check-input" type="checkbox" value="{{ $option['name'] }}" id="{{ $id }}-{{ $key }}" @if(in_array($option['name'], $currentFilters)) checked @endif>
            <label class="form-check-label" for="{{ $id }}-{{ $key }}">
                {{ $option['name'] }} <span class="text-secondary small">({{ $option[$countName] }})</span>
            </label>
        </div>
    @endforeach
</div>
