<?php
/**
 * @param $label
 * @param $name
 * @param $items
 * @param $item_filters
 * @param bool $inline
 */
?>
<div class="filter-checkbox-container mb-3" aria-label="Filter by {{ $label }}">
    <label for="{{ $name }}-filter" class="h4">{{ $label }}</label>
    @isset($items)
        <div id="{{ $name }}-filter">
            @foreach ($items as $item)
                @if($loop->index == 10)
                    <button class="toggle-more btn btn-sm font-weight-bold text-uppercase btn-link text-info p-0 text-decoration-none" type="button" data-toggle="collapse" data-target="#filters-more-{{ $name }}" aria-expanded="false" aria-controls="filters-more-{{ $name }}">
                        <span>Show More</span><i class="fad fa-arrow-square-down text-info ml-2"></i>
                    </button>
                    <div id="filters-more-{{ $name }}" class="collapse js-collapse-filter">
                @endif

                    <div class="custom-control custom-checkbox {{ isset($inline) ? 'custom-control-inline' : '' }}">
                        <input type="checkbox" class="custom-control-input" name="{{ $name }}" id="{{ $name }}{{ $item }}" value="{{ $item }}" @if (in_array($item, $item_filters)) checked @endif>
                        <label class="custom-control-label" for="{{ $name }}{{ $item }}">{{ $item }}</label>
                    </div>

                @if($loop->last AND $loop->index >= 10)
                    </div>
                @endif
            @endforeach
        </div>
    @endisset
</div>
