<div class="card shadow-sm mb-5">
    <div class="card-header bg-none">
        <h3 class="h1 mb-0 border-bottom">Upcoming Events</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            @foreach ($latest_events as $event)
                <div class="p-3 d-flex d-md-block d-lg-flex @if(!$loop->last) border-bottom @endif">
                    <div class="image mr-3">
                        <a href="{{ route('discover.events.show', $event->slug) }}">
                            <div class="job-org-logo" style="background-image: url('{{ $event->entityImageUrl }}');"></div>
                        </a>
                    </div>
                    <div class="text">
                        <p class="lead mb-0">
                            <a href="{{ route('discover.events.show', $event->slug) }}" title="{{ $event->name }}">{{ $event->name }}</a>
                        </p>
                        <p class="mb-0">
                            <span class="text-muted"><i class="fad fa-calendar"></i></span>
                            <strong>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</strong>
                        </p>
                        @if ($event->locations->count() > 0)
                            <p class="mb-0">
                                <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                                @foreach ($event->locations as $location)
                                    {{ $location->name }}@if (!$loop->last),@endif
                                @endforeach
                            </p>
                        @endif
                        @if ($event->focus->count() > 0)
                            <p class="mb-0">
                                <span class="text-secondary"><i class="fad fa-flask"></i></span>
                                @foreach($event->focus as $item)
                                    {{ $item->name }}@if (!$loop->last),@endif
                                @endforeach
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer bg-none text-center">
        <a href="{{ route('discover.events') }}" class="btn btn-dark">Browse All Events</a>
    </div>
</div>
