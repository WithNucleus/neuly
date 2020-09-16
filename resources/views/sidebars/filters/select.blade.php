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
    <label for="{{ $name }}-filter" class="h4">{{ $label }}</label><br>
    @isset($items)
        <select class="form-control" id="{{ $name }}-filter" name="{{ $name }}" {{ isset($multi) ? 'multiple' : '' }}>
            @foreach ($items as $item)
                <option value="{{ $item }}" {{ in_array($item, $item_filters) ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
    @endisset
</div>
