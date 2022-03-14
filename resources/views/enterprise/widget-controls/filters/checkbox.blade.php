@foreach ($filterValues as $value => $label)
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="{{ $className . $value }}" data-name="{{ $label }}">
        <label class="custom-control-label" for="{{ $className . $value }}">{{ $label }}</label>
    </div>
@endforeach
