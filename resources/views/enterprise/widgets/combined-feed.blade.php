<ul class="list-group shadow-sm">
    @foreach($feed as $item)
        <li class="list-group-item">
            <div class="d-flex">
                @if ($item->icon_url == '')
                    <div class="cf-neutral-icon">
                        {!! $item->media_icon !!}
                    </div>
                @else
                    <div class="cf-feed-icon" style="background-image: url({{ $item->icon_url }})"></div>
                @endif
                <div>
                    <a href="{{ $item->url }}" class="d-block font-weight-bold mb-1" target="_blank" rel="noopener noreferrer">
                        {{ $item->name }}
                    </a>
                    <div class="text-quarternary mb-1">
                        {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}
                    </div>
                    @if ($item->focus->count() > 0)
                        <div class="text-secondarydark">
                            <i class="fad fa-flask"></i>
                            @foreach($item->focus as $item)
                                {{ $item->name }}@if (!$loop->last),@endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
