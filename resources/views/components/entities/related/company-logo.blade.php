<a href="{{ $company->show_url }}" class="d-block mt-3 me-3" title="{{ $company->name }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $company->name }}">
    @if($company->entityImageUrl)
        <img src="{{ $company->entityImageUrl }}" class="img-height-30" alt="{{ $company->name }}" height="30">
    @else
        <small class="truncate-100">{{ $company->name }}</small>
    @endif
</a>
