<div class="row">
    <div class="col-12 col-md-6 order-2 order-md-1">
        <div class="h3 text-primary">
            @if($event->end_date != '')
                {{ Carbon\Carbon::parse($event->start_date)->format('M j') }} &ndash; {{ Carbon\Carbon::parse($event->end_date)->format('M j, Y') }}
            @else
                {{ Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
            @endif
        </div>

        @if($event->eventTypes->count() > 0)
            <div class="d-flex align-items-center h5 my-3">
                @foreach($event->eventTypes as $eventType)
                    <span class="me-2">{{ $eventType->name }}</span>
                @endforeach
            </div>
        @endif

        @if($event->focus->count() > 0)
            <div class="d-flex flex-wrap align-items-center my-3">
                @foreach ($event->focus as $item)
                    <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="col-12 col-md-6 order-1 order-md-2 mb-4 mb-md-0">
        <div class="logo-is-contained" style="background-image: url('{{ $event->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
    </div>
</div>

<div class="d-lg-flex">
    <div class="my-4 max-width-780 flex-grow-1">
        <h3 class="h4 border-bottom">Description</h3>
        <div class="lead">
            {!! $event->description !!}
        </div>
    </div>
    <div class="my-4 ms-lg-5 flex-shrink-0">
        @if($event->locations->count() > 0)
            <h3 class="h4 border-bottom">Locations</h3>
            <div class="w-auto d-flex">
                <ul class="list-group list-group-flush lead me-auto w-auto">
                    @foreach ($event->locations as $location)
                        <x-entities.related.location-list-item :location="$location" />
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<div class="d-flex align-items-center">
    @if($event->event_url)
        <div class="me-3">
            <a href="{{ $event->event_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">More Info</a>
        </div>
    @endif

    @if($event->registration_url)
        <div class="me-3">
            <a href="{{ $event->registration_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-accent btn-lg">Register</a>
        </div>
    @endif
</div>

@if($event->companies->count() > 0 OR $event->people->count() > 0)
    <div class="mt-5">
        <h2 class="h3">Exhibitors / Speakers</h2>
        <div class="row">
            @foreach ($event->companies as $company)
                <x-entities.related.company-card :company="$company" />
            @endforeach
            @foreach ($event->people as $person)
                <x-entities.related.person-card :person="$person" />
            @endforeach
        </div>
    </div>
@endif
