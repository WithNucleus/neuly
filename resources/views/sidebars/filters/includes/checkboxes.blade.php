<?php
/**
 * @param $label
 * @param $name
 * @param $items
 * @param $column
 */
?>
<div class="filter-checkbox mb-3" aria-label="Filter by {{ $label }}" data-column="{{ $column }}">
    <label for="{{ $name }}-filter" class="h4">{{ $label }}</label>
    @isset($items)
        <div id="{{ $name }}-filter">
            @foreach ($items as $item)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="{{ $name }}" id="{{ $item }}" value="{{ $item }}">
                    <label class="custom-control-label" for="{{ $item }}">{{ $item }}</label>
                </div>
            @endforeach
        </div>
    @endisset
</div>