<ul class="list-group list-group-flush mb-4 border">
    @foreach($clinicalTrials as $trial)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <a href="{{ route('discover.clinicaltrials.show', $trial->slug) }}">{{ $trial->title }}</a>
            </p>
            <div class="widget-expandable-details">
                @if($trial->focus->count() > 0)
                    <p class="text-secondarydark mb-1">
                        <i class="fad fa-flask"></i>
                        @foreach ($trial->focus as $item)
                            {{ $item->name }}@if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if($trial->companies->count() > 0)
                    <p class="text-info mb-1">
                        <i class="fad fa-building"></i>
                        @foreach ($trial->companies as $item)
                            <a href="{{ route('discover.organizations.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                            @if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if($trial->people->count() > 0)
                    <p class="text-info mb-1">
                        <i class="fad fa-user"></i>
                        @foreach ($trial->people as $item)
                            <a href="{{ route('discover.people.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                            @if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if ($trial->phases != '')
                    <p class="mb-1">
                        <i class="fad fa-clock text-quaternary"></i> {{ $trial->phases }}
                    </p>
                @endif
                <p class="mb-1">
                    <i class="fad fa-info-circle text-danger"></i> {{ $trial->status }}
                </p>
                @if ($trial->start_date != '' OR $trial->last_update_posted != '')
                    <p class="mb-2">
                        <i class="fad fa-calendar-day text-quaternary mr-1"></i>
                        @if ($trial->start_date != '')
                            <span class="mr-3">
                            <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($trial->start_date)->format('F Y') }}
                        </span>
                        @endif

                        @if ($trial->last_update_posted != '')
                            <span class="mr-3">
                            <strong>Updated:</strong> {{ \Carbon\Carbon::parse($trial->last_update_posted)->format('F Y') }}
                        </span>
                        @endif
                    </p>
                @endif
            </div>
        </li>
    @endforeach
</ul>
