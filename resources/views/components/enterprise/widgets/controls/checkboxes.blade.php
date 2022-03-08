@props([
    'id' => '',
    'filter' => 'focus',
    'url' => ''
])

<div class="filter-checkboxes" data-filter="{{ $filter }}" data-url="{{ $url }}">
    <div class="collapse filter-group" id="{{ $id }}">
        Loading filters...
    </div>
</div>
