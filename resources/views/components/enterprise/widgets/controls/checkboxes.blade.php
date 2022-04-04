@props([
    'id' => '',
    'filter' => 'focus',
    'url' => ''
])

<div class="filter-checkboxes" data-filter="{{ $filter }}" data-url="{{ $url }}">
    <div class="collapse filter-group bg-white border shadow-sm px-3 py-2" id="{{ $id }}">
        Loading filters...
    </div>
</div>
