<?php
/**
 * @param string $title
 * @param string $placeholder 	
 * @param string $prefetch 		URL to get the JSON data
 * @param integer $column 		DataTable column
 */
?>
<div class="filter-textsearch filter-tagsinput mb-3" aria-label="Filter by {{ $title }}" data-prefetch="{{ $prefetch }}" data-column="{{ $column }}">
    <label for="" class="h4">{{ $title }}</label>
    <br />
    <div>
        <input class="bootstrap-tagsinput" type="text" placeholder="{{ $placeholder }}">
    </div>
</div>
