@if ($bookableListing->bookable_type == \App\Models\Person::class)
    <div class="logo-square-is-contained rounded-circle"
     style="background-image: url('{{ $bookableListing->entityImageUrl ?? asset('images/image-placeholder-care-square.png') }}');">
        <span class="visually-hidden">{{ $bookableListing->name }}</span>
    </div>
@else
    <div class="logo-is-contained mb-3"
     style="background-image: url('{{ $bookableListing->entityImageUrl ?? asset('images/image-placeholder-care.png') }}');">
        <span class="visually-hidden">{{ $bookableListing->name }}</span>
    </div>
@endif
