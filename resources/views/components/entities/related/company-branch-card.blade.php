<div class="col-12 col-md-6 col-xl-4 mb-3 lead">
    <address class="mb-1">
        <a href="https://google.com/maps/place/{!! $companyBranch->fullAddressForGoogle !!}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">{!! $companyBranch->fullAddress !!}</a>
    </address>
    @if ($companyBranch->phone != '')
        <span class="d-block">
            <a href="tel:{{ $companyBranch->phone }}" class="text-decoration-none">
                <i class="fa-sharp fa-solid fa-square-phone me-1"></i>{{ $companyBranch->phone }}
            </a>
        </span>
    @endif
</div>
