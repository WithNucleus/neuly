<a href="{{ $person->show_url }}" class="d-block mt-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $person->name }}">
    @if($person->entityImageUrl)
        <img src="{{ $person->entityImageUrl }}" class="img-height-30 rounded-circle" alt="{{ $person->name }}" height="30">
    @else
        <small>{{ $person->name }}</small>
    @endif
</a>
