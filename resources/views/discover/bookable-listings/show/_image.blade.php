@if ($bookableListing->bookable_type == \App\Models\Person::class)
    <div class="logo-square-is-contained rounded-circle"
     style="background-image: url('{{ $bookableListing->image ?? asset('images/person-blank.png') }}');">
        <span class="visually-hidden">{{ $bookableListing->name }}</span>
    </div>
@else
    <div class="logo-is-contained"
     style="background-image: url('{{ $bookableListing->image ?? asset('images/image-placeholder.jpg') }}');">
        <span class="visually-hidden">{{ $bookableListing->name }}</span>
    </div>
@endif
