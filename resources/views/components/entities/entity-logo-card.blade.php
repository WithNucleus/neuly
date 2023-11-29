<div class="card h-100 {{ $cardBodyClasses }}">
    <div class="card-body text-center d-flex justify-content-center align-items-stretch card-hover {{ $cardClasses }}">
        <a href="{{ $url }}" class="text-decoration-none w-100 {{ $linkClasses }}">
            {{ $slot }}
        </a>
    </div>
</div>
