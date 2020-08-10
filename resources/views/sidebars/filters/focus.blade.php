<?php
/**
 * @param Collection $focus_cats
 * @param integer $column
 */
?>
<div class="filter-checkbox focus-filter mb-3" aria-label="Filter by Focus" data-column="{{ $column }}">
    <label for="focus" class="h4">Focus</label>

    @isset($focus_cats)

        <div id="focus-filter">
            @foreach ($focus_cats as $focus)

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="focus" id="{{ $focus }}" value="{{ $focus }}">
                <label class="custom-control-label" for="{{ $focus }}">{{ $focus }}</label>
            </div>
            @endforeach
        </div>
    @endisset

</div>
