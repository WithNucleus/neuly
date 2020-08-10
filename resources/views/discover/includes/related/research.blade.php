@if(count($related) > 0)

    <h4 class="mt-5">Related Research:</h4>
    <div class="card-deck mt-2">
        @foreach($related as $index => $item)
            <div class="card">
                <div class="card-body shadow-sm">
                    <p class="lead mb-1">
                        <a href="{{ route('discover.research.show', ['slug' => $item->slug]) }}">{{$item->name}}</a>
                    </p>
                    <p class="mb-2 pb-2 border-bottom">
                        <?php
                        $abstract = substr($item->abstract, 0, 120);
                        ?>
                        {{ $abstract }}...
                    </p>

                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0">
                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                @foreach($item->focus as $focus)
                                    {{ $focus->name }}@if (!$loop->last),@endif
                                @endforeach
                            </p>
                        </div>
                        <div>
                            @if($item->people->count() > 0)
                                <p class="mb-0">
                                    <span class="text-danger"><i class="fad fa-pen-fancy"></i></span>
                                    @foreach($item->people as $person)
                                        <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>@if (!$loop->last),@endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
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