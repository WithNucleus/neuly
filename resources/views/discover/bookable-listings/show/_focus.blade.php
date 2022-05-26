@if($bookableListing->focus->count() > 0)
    <p class="lead mb-2 text-secondarydark">
        @foreach ($bookableListing->focus as $item)
            {{ $item->name }} @if (!$loop->last) / @endif
        @endforeach
    </p>
@endif
