@foreach ($filterValues as $value => $label)
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="{{ $className . $value }}" data-name="{{ $label }}">
        <label class="form-check-label" for="{{ $className . $value }}">{{ $label }}</label>
    </div>
@endforeach
