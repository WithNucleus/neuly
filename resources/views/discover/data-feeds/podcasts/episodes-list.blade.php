@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Podcasts' => route('discover.podcasts'),
            $feed->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <div class="max-width-1000 mx-auto">
            <x-entities.entity-show-title-meta title="{{ $feed->name }}"></x-entities.entity-show-title-meta>

            <div class="d-md-flex pb-5 mb-5 border-bottom">
                <div class="flex-shrink-0">
                    <img src="{{ $feed->entity_image_url ?? asset('images/image-placeholder-podcast.png') }}" alt="{{ $feed->name }}" class="d-none d-md-block entity-square-image mb-3">
                </div>
                <div class="lead ms-md-4">
                    <p class="h4 text-body-tertiary">
                        {{ $feed->mediaItems->count() }} episodes
                    </p>
                    <div class="text-body-secondary">{{ $feed->summary }}</div>
                </div>
            </div>
        </div>

        <div>
            @foreach($episodes as $episode)
                <div class="d-flex justify-content-center">
                    <livewire:public.entities.show.podcast-widget :record="$episode" :wire:key="$episode->slug" hideSource="true" />
                </div>
            @endforeach

            <div>
                {{ $episodes->links() }}
            </div>
        </div>

        @can('import')
            <div class="text-uppercase small fw-bold text-secondary-emphasis mt-4">
                <a href="{{ route('admin.datafeed.edit', $feed->id) }}" class="text-secondary-emphasis">Edit Data Feed</a>
            </div>
        @endcan
    </div>

@endsection
