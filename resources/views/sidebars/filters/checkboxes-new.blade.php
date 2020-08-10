<?php
/**
 * @param $label
 * @param $name
 * @param $items
 * @param $item_filters
 */
?>
<div class="filter-checkbox-container mb-3" aria-label="Filter by {{ $label }}">
    <label for="{{ $name }}-filter" class="h4">{{ $label }}</label>
    @isset($items)
        <div id="{{ $name }}-filter">
            @foreach ($items as $item)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="{{ $name }}" id="{{ $item }}" value="{{ $item }}" @if (in_array($item, $item_filters)) checked @endif>
                    <label class="custom-control-label" for="{{ $item }}">{{ $item }}</label>
                </div>
            @endforeach
        </div>
    @endisset
</div>