@props([
    'target',
    'label' => 'Focus Filter',
])

<button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse" data-target="#{{ $target }}" aria-expanded="false" aria-controls="{{ $target }}">
    {{ $label }}
</button>
