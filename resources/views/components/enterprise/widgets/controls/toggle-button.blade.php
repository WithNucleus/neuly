@props([
    'target',
    'label' => 'Focus Filter',
])

<button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $target }}" aria-expanded="false" aria-controls="{{ $target }}">
    {{ $label }}
</button>
