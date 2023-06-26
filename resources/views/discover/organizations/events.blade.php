@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Organizations' => route('discover.organizations'),
            $company->name  => route('discover.organizations.show', $company->slug),
            'Events' => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">
        <h1>Events at {{ $company->name }}</h1>

        <div class="list-group list-group-flush">
            @forelse($company->events as $event)
                <div class="list-group-item py-3 px-0">

                    <h2 class="h4">
                        <a href="{{ route('discover.events.show', $event->slug) }}" class="text-decoration-none">{{ $event->name }}</a>
                    </h2>

                    <div>
                        <span class="text-danger"><i class="fad fa-calendar-star"></i></span>
                        <strong class="mr-4">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</strong>
                    </div>

                    @if($event->locations->count() > 0)
                        <div>
                            <span class="text-success"><i class="fad fa-globe-stand"></i></span>
                            @foreach ($event->locations as $location)
                                {{ $location->name }}@if (!$loop->last),@endif
                            @endforeach
                        </div>
                    @endif

                    @if($event->focus->count() > 0)
                        <div>
                            <span class="text-secondary"><i class="fad fa-flask"></i></span>
                            @foreach($event->focus as $item)
                                {{ $item->name }}@if (!$loop->last),@endif
                            @endforeach
                        </div>
                    @endif

                </div>
            @empty
                No events
            @endforelse
        </div>

    </div>

@endsection
