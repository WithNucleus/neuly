<?php
/**
 * @param integer $column
 */
?>
<div id="location-filter" class="filter-tagsinput mb-3" aria-label="Filter by Location" data-column="{{ $column }}">
    <label for="filterLocation" class="h4">Location</label><br>
    
    <div id="bloodhound">
        <input class="locationSearch typeahead bootstrap-tagsinput" type="text" placeholder="e.g. Canada or New York">
    </div>
</div>
