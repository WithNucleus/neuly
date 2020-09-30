<?php
/**
 * @param $label
 * @param $name
 * @param $items
 * @param $action
 */
?>
<div class="js-typeahead-filter-container mb-3">
    <label class="h4">{{ $label }}</label>
    <div class="d-flex">
        <input type="text" class="js-typeahead-filter form-control" name="{{ $name }}" placeholder="Search {{ $label }}"
            data-action="{{ $action }}">
        <button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
    </div>

    <div class="js-typeahead-filter-values">
        <span class="d-block title"></span>

        @foreach ($items as $i => $item)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="{{ $name }}" id="{{ $item }}" value="{{ $item }}" checked>
                <label class="custom-control-label" for="{{ $item }}">{{ $item }}</label>
            </div>
        @endforeach
    </div>
</div>
