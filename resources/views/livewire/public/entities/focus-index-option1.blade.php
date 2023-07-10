<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search videos" placeholder="Search" search="{{ $search }}" tooltip="Search by keyword..." />

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <h1 class="text-body-emphasis">Explore the Psychedelics Industry by Focus</h1>
        <div class="my-3 text-center">
            <x-entities.offcanvas-sidebar-toggle />
        </div>
        <div class="row">
            @forelse ($records as $record)
                <div wire:key="{{ $record->slug }}" class="col-12 col-sm-6 col-lg-4 col-lg-3 mb-4">
                    <x-entities.entity-logo-card url="{{ route('discover.focus.show', $record->slug) }}" linkClasses="py-5">
                        <h3 class="text-success">{{ $record->name }}</h3>

                        <div class="d-flex justify-content-center flex-wrap lead text-uppercase">
                            @if($record->companies_count > 0)
                                <x-badge.tertiary-badge>{{ $record->companies_count }} {{ $record->companies_count === 1 ? 'Organization' : 'Organizations' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->people_count > 0)
                                <x-badge.tertiary-badge>{{ $record->people_count }} {{ $record->people_count === 1 ? 'Person' : 'People' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->events_count > 0)
                                <x-badge.tertiary-badge>{{ $record->events_count }} {{ $record->events_count === 1 ? 'Event' : 'Events' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->jobs_count > 0)
                                <x-badge.tertiary-badge>{{ $record->jobs_count }} {{ $record->jobs_count === 1 ? 'Job' : 'Jobs' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->news_count > 0)
                                <x-badge.tertiary-badge>{{ $record->news_count }} {{ $record->news_count === 1 ? 'News Article' : 'News Articles' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->books_count > 0)
                                <x-badge.tertiary-badge>{{ $record->books_count }} {{ $record->books_count === 1 ? 'Book' : 'Books' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->courses_count > 0)
                                <x-badge.tertiary-badge>{{ $record->courses_count }} {{ $record->courses_count === 1 ? 'Course' : 'Courses' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->podcasts_count > 0)
                                <x-badge.tertiary-badge>{{ $record->podcasts_count }} {{ $record->podcasts_count === 1 ? 'Podcast' : 'Podcasts' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->videos_count > 0)
                                <x-badge.tertiary-badge>{{ $record->videos_count }} {{ $record->videos_count === 1 ? 'Video' : 'Videos' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->research_count > 0)
                                <x-badge.tertiary-badge>{{ $record->research_count }} Research</x-badge.tertiary-badge>
                            @endif
                            @if($record->clinicaltrials_count > 0)
                                <x-badge.tertiary-badge>{{ $record->clinicaltrials_count }} {{ $record->clinicaltrials_count === 1 ? 'Clinical Trial' : 'Clinical Trials' }}</x-badge.tertiary-badge>
                            @endif
                            @if($record->bookable_listings_count > 0)
                                <x-badge.tertiary-badge>{{ $record->bookable_listings_count }} {{ $record->bookable_listings_count === 1 ? 'Bookable Listing' : 'Bookable Listings' }}</x-badge.tertiary-badge>
                            @endif
                        </div>
                    </x-entities.entity-logo-card>
                </div>

            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        Nothing matches your search criteria.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
