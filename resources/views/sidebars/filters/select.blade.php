<?php
/**
 * @param $label
 * @param $name
 * @param $items
 * @param $item_filters
 * @param bool $multi
 */
?>
<div class="filter-checkbox-container mb-3" aria-label="Filter by {{ $label }}">
    <label for="{{ $name }}-filter" class="h4 d-block">{{ $label }}</label>
    @isset($items)
        <select class="custom-select" id="{{ $name }}-filter" name="{{ $name }}" {{ isset($multi) ? 'multiple' : '' }}>
            <option></option>
            @foreach ($items as $item)
                <option value="{{ $item }}" {{ in_array($item, $item_filters) ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
    @endisset
</div>
