<?php
/**
 * @param array $filters_location
 */
?>
<div class="filter-locations mb-4">
    <label class="h4">{{ $label }}</label>
    <div class="d-flex">
        <input type="text" class="typeahead form-control" name="locations-search" placeholder="e.g. New York" data-action-url="{!! $actionUrl !!}">
        <button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
    </div>

    <div id="locations-filter">
        <span class="d-block title"></span>

        @isset($filters_location)
            @foreach ($filters_location as $location)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="locations" id="{{ $location }}" value="{{ $location }}" checked>
                    <label class="custom-control-label" for="{{ $location }}">{{ $location }}</label>
                </div>
            @endforeach
        @endisset
    </div>
</div>
