@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    @include('discover.includes.status-messages')

    <h1>{{ $feed->name }}</h1>
    <p class="lead mb-2 text-secondarydark">
        {{ $feed->mediaItems->count() }} episodes
    </p>
    <div class="row col-12 col-xl-8">
        <p class="lead mb-0 text-muted">
            {{ $feed->summary }}
        </p>

        <ul class="list-group list-group-flush">
            @foreach($episodes as $item)
                <li class="list-group-item px-0 pb-4 pt-4">
                    <a href="{{ $item->url }}" class="lead" target="_blank" rel="noopener noreferrer">
                        {{ $item->name }}
                    </a>
                    <span class="d-block text-muted">
                    {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}
                </span>
                    <span class="d-block">
                    {{ $item->summary }}
                </span>
                </li>
            @endforeach
        </ul>
    </div>

    {{ $episodes->links() }}

    @include('discover.includes.show-end')

    <style>
        .episode-date {
            display: inline-block;
            min-width: 110px;
        }
    </style>

@endsection
