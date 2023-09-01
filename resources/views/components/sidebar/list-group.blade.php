<ul class="list-unstyled ps-0">
    <li class="mb-1">
        <button
            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 {{ ($currentRoute === $groupRoute) ? 'show active' : 'collapsed' }}"
            data-bs-toggle="collapse" data-bs-target="#{{ $groupRoute }}" aria-expanded="{{ ($currentRoute === $groupRoute) ? 'true' : 'false' }}">
            {{ $label }}
        </button>
        <div class="collapse {{ ($currentRoute === $groupRoute) ? 'show' : '' }}" id="{{ $groupRoute }}">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                {{ $slot }}
            </ul>
        </div>
    </li>
</ul>
