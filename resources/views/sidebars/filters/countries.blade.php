<?php
/**
 * @param integer $column
 */
?>

<div id="country_search">
    <div id="country-filter" class="mb-3" aria-label="Filter by Country" data-column="{{ $column }}">
        <label for="country" class="h4">Country</label>

        @foreach ($countries as $key => $country)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="country" id="{{ $country }}" value="{{ $country }}">
                <label class="custom-control-label" for="{{ $country }}">{{ $country }}</label>
            </div>
        @endforeach

        
    </div>
</div>