@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

	<h1>Events at {{ $company->name }}</h1>

    <div class="list-group list-group-flush">
        @forelse($company->events as $event)
            <div class="list-group-item">

                    <p class="lead-smaller mb-0">
                       <a href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a>
                    </p>

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

	@include('discover.includes.show-end')
    @include('discover.includes.limited-access-modal')
@endsection
