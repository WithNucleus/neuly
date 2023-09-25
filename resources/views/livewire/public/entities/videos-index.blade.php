<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="h5 d-none d-lg-block mb-4 text-body-emphasis">Narrow Your Search</h3>

            <x-livewire-filters.search label="Search videos" placeholder="Search" search="{{ $search }}" tooltip="Search by keyword..." />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusOptions" :currentFilters="$filters['focus']" countName="videos_count" />
            </div>

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Videos</h1>
                <div class="lead">
                    {{ number_format($records->total()) }} Videos
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Episode Title" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date" field="date" :sorts="$sorts" />
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($records as $record)
                <div class="col-12 col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center d-flex justify-content-center align-items-stretch">
                            <div class="d-flex flex-column justify-content-between w-100">
                                <div class="w-100">
                                    <div class="video-content mb-2">
                                        {!! $record->content !!}
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <h2 class="h4 mt-3">
                                        {{ $record->name }}
                                    </h2>
                                    @if($record->focus->count() > 0)
                                        <p class="mb-2 text-secondarydark">
                                            <i class="fad fa-flask"></i>
                                            @foreach ($record->focus as $item)
                                                {{ $item->name }}@if (!$loop->last) / @endif
                                            @endforeach
                                        </p>
                                    @endif
                                    @if($record->summary != '')
                                        <div class="mb-2">
                                            {{ $record->summary }}
                                        </div>
                                    @endif
                                    <span>
                                        {{ Carbon\Carbon::parse($record->date)->diffForHumans() }}
                                    </span>
                                    @if($record->source)
                                        <span class="mx-1">&bull;</span>
                                        <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer">
                                            {{ $record->source->name }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No videos match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>
    <style>
        .video-content {
            width: 100%;
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .video-content iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

</div>
