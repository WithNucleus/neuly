<div class="my-4">
    <h3 class="collapse-heading bg-success">
        <button data-bs-toggle="collapse" href="#{{ $collapsableId }}" aria-expanded="true" aria-controls="{{ $collapsableId }}" class="btn text-white">
            <span class="d-block mt-1">{{ $label }}</span>
            <i class="fa-sharp fa-solid fa-angle-down"></i>
        </button>
    </h3>
    <div class="collapse multi-collapse show" id="{{ $collapsableId }}">
        <div class="row pt-3">
            {{ $slot }}
        </div>
    </div>
</div>
