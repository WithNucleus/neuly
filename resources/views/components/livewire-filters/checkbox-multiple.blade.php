<div>
    @foreach ($options as $key => $option)
        <div class="form-check {{ $class }}">
            <input wire:model.lazy="{{ $wireModel }}" class="form-check-input" type="checkbox" value="{{ $option }}" id="{{ $id }}-{{ $key }}" @if(in_array($option, $currentFilters)) checked @endif>
            <label class="form-check-label" for="{{ $id }}-{{ $key }}">
                {{ $option }}
            </label>
        </div>
    @endforeach
</div>
