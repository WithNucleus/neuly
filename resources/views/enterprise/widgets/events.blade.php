<ul class="list-group">
    @forelse($events as $event)
        <li class="list-group-item d-md-flex">
            <div class="logo-icon widget-expandable-details" style="background-image: url('{{ $event->entityImageUrl }}');"></div>
            <div class="text">
                <p class="mb-1 font-weight-bold">
                    <a href="{{ route('discover.events.show', $event->slug) }}">
                        {{ $event->name }}
                    </a>
                </p>
                <div class="widget-expandable-details">
                    <p class="mb-1">
                        <span class="text-danger"><i class="fad fa-calendar"></i></span>
                        {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                    </p>

                    @if($event->eventTypes->count() > 0)
                        <p class="mb-1">
                            <span class="text-quaternary"><i class="fad fa-list-ul"></i></span>
                            @foreach ($event->eventTypes as $type)
                                {{ $type->name }}@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif

                    @if($event->focus->count() > 0)
                        <p class="mb-1">
                            <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                            @foreach ($event->focus as $focus)
                                {{ $focus->name }}@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif

                    @if($event->locations->count() > 0)
                        <p class="mb-1">
                            <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                            @foreach ($event->locations as $location)
                                {{ $location->name }}@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif

                    @if($event->companies->count() > 0)
                        <p class="mb-1">
                            <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                            @foreach ($event->companies as $company)
                                {{ $company->name }}@if (!$loop->last) / @endif
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
        </li>
    @empty
        <li class="list-group-item">
            <p class="mb-0">
                No events match your search criteria.
            </p>
        </li>
    @endforelse
</ul>
