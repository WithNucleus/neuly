<button wire:click="sortBy('{{ $field }}')" :direction="$sorts[{{ $field }}] ?? null"
        class="btn btn-link text-decoration-none text-uppercase {{ array_key_exists($field, $sorts) ? ($activeClasses ?? 'text-primary') : $inactiveClasses ?? 'text-secondary' }} {{ $buttonClasses ?? 'fw-bold px-0 me-3' }}">
    <span class="me-1">{{ $label }}</span>
    @if(array_key_exists($field, $sorts))
        @if ($sorts[$field] === 'asc')
            <span><i class="fa-sharp fa-solid fa-angle-up"></i></span>
        @else
            <span><i class="fa-sharp fa-solid fa-angle-down"></i></span>
        @endif
    @else
        <span><i class="fa-sharp fa-solid fa-angle-up opacity-50"></i></span>
    @endif
</button>
