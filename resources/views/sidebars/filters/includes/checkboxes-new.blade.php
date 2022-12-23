<?php
/**
 * @param string $label
 * @param string $name
 * @param array $items
 * @param array $item_filters
 * @param bool $inline
 */

$initialShowedItems = 10;
$showMoreOpened = false;

//TODO on refactoring filters phase, pass $items everywhere as an array
if (isset($items) and $items instanceof \Illuminate\Support\Collection) {
    $items = $items->toArray();
}

if (count($items) > $initialShowedItems && isset($item_filters)) {
    $hiddenItems = array_slice($items, $initialShowedItems);

    foreach ($item_filters as $filteredItem) {
        if (in_array($filteredItem, $hiddenItems) === true) {
            $showMoreOpened = true;
            break;
        }
    }
}

?>
<div class="filter-checkbox-container mb-3" aria-label="Filter by {{ $label }}">
    <label for="{{ $name }}-filter" class="h4">{{ $label }}</label>
    @isset($items)
        <div id="{{ $name }}-filter">
            @foreach ($items as $item)
                @if($loop->index == $initialShowedItems)
                    <button class="toggle-more btn btn-sm font-weight-bold text-uppercase btn-link text-info p-0 text-decoration-none" type="button" data-toggle="collapse" data-target="#filters-more-{{ $name }}" aria-expanded="false" aria-controls="filters-more-{{ $name }}">
                        <span>Show More</span><i class="fad fa-arrow-square-down text-info ml-2"></i>
                    </button>
                    <div id="filters-more-{{ $name }}" class="collapse js-collapse-filter {{ $showMoreOpened ? 'show' : '' }}">
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
