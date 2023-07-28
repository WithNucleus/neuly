@props([
    'widgetName',
    'default' => 5,
    'sizeOptions' => [5, 10, 15, 20, 25, 50]
])

<div class="number-pages d-flex align-items-center ms-4">
    <select id="{{ $widgetName }}-page-size" class="form-select form-select-sm d-inline-block auto-width page-size">
        @foreach ($sizeOptions as $size)
            <option value="{{ $size }}" @if($default == $size) selected @endif>{{ $size }}</option>
        @endforeach
    </select>
    <label for="{{ $widgetName }}-page-size" class="ms-2">items</label>
</div>
