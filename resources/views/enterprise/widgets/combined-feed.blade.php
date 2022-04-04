<ul class="list-group">
    @foreach($feed as $item)
        <li class="list-group-item">
            <div class="d-flex">
                @if ($item->icon_url == '')
                    <div class="cf-neutral-icon widget-expandable-details">
                        {!! $item->media_icon !!}
                    </div>
                @else
                    <div class="cf-feed-icon widget-expandable-details" style="background-image: url({{ $item->icon_url }})"></div>
                @endif
                <div>
                    <a href="{{ $item->url }}" class="d-block font-weight-bold mb-1" target="_blank" rel="noopener noreferrer">
                        {{ $item->name }}
                    </a>
                    <div class="widget-expandable-details">
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
                        <div>
                            {{ $item->summary }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
