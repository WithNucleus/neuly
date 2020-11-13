@if(count($related) > 0)
    <h4 class="mt-5">Related Organizations:</h4>
    <div class="card-deck mt-2">
        @foreach($related as $index => $item)
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center d-flex justify-content-center align-items-center">
                    @if($item->entityImageUrl)
                        <a href="{{ route('discover.organizations.show', ['slug' => $item->slug]) }}" data-toggle="tooltip" data-placement="top" title="{{$item->name}}">
                            <img src="{{ $item->entityImageUrl }}" alt="{{ $item->name }}" class="company-logo mx-auto" alt="{{$item->name}}">
                        </a>
                    @else
                        <a href="{{ route('discover.organizations.show', ['slug' => $item->slug]) }}">{{$item->name}}</a>
                    @endif
                </div>
                <div class="card-footer">
                    <strong>Focus:</strong>
                    @foreach ($item->focus as $focus)
                        <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>@if (!$loop->last),@endif
                    @endforeach
                </div>
            </div>
            @if($index === 2)
                </div>
                <div class="card-deck mt-4">
            @endif
        @endforeach
    </div>
@endif
