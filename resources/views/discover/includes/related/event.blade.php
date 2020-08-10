@if(count($related) > 0)
    <h4 class="mt-5">Related Events:</h4>
    <div class="card-deck mt-2">
        @foreach($related as $index => $item)
            <div class="card shadow-sm">
                {{-- <div class="card-header">
                    <a href="{{ route('discover.events.show', ['slug' => $item->slug]) }}">{{$item->name}}</a>
                </div> --}}
                <div class="card-body">
                    <p class="lead mb-0">
                        <a href="{{ route('discover.events.show', ['slug' => $item->slug]) }}">{{$item->name}}</a>
                    </p>
                    <div>
                        <p class="mb-0">
                            <span class="text-danger"><i class="fad fa-calendar-star"></i></span>
                            <strong class="mr-4">{{ \Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}</strong>

                            <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                            @foreach ($item->locations as $location)
                                {{ $location->name }}@if (!$loop->last),@endif
                            @endforeach
                        </p>
                        <p class="mb-0">
                            <span class="text-secondary"><i class="fad fa-flask"></i></span>
                            @foreach($item->focus as $focus)
                                {{ $focus->name }}@if (!$loop->last),@endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            @if($index%2 === 1)
    </div>
    <div class="card-deck mt-4">
        @endif
        @endforeach
    </div>
@endif