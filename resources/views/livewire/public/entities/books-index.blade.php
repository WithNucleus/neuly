<div class="d-flex flex-column flex-lg-row w-100">
    <div class="entity-index-sidebar">
        <x-entities.offcanvas-sidebar>
            <h3 class="d-none d-lg-block mb-4 text-body-emphasis">Filters</h3>

            <x-livewire-filters.search label="Search books" placeholder="Search" search="{{ $search }}" tooltip="Search by title, keyword, author..." />

            <div class="my-4">
                <h4 class="h5 text-body-emphasis">Focus</h4>
                <x-livewire-filters.checkbox-multiple-with-count wireModel="filters.focus" id="filter-focus" :options="$focusOptions" :currentFilters="$filters['focus']" countName="books_count" />
            </div>

            <div>
                <button wire:click="clearFilters" class="btn btn-sm btn-secondary">Clear Filters</button>
            </div>
        </x-entities.offcanvas-sidebar>
    </div>
    <div class="entity-index-listings w-100">
        <div class="row">
            <div class="col-12 d-md-flex justify-content-between align-items-end">
                <h1 class="me-4 mb-md-0 text-body-emphasis">Books</h1>
                <div class="lead">
                    {{ $records->total() }} Books
                </div>
            </div>
            <div class="col-12 my-3">
                <x-entities.offcanvas-sidebar-toggle />
                <div>
                    <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" />
                    <x-entities.entity-index-sort-button label="Date" field="date" :sorts="$sorts" />
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($records as $record)
                <div wire:key="{{ $record->id }}" class="mb-5 d-lg-flex">
                    <div class="d-md-flex border-bottom pb-5">
                        <div class="flex-shrink-0 mb-3 mb-md-0 me-md-3 me-lg-4">
                            <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $record->icon_url ?? asset('images/image-placeholder-book.png') }}" alt="{{ $record->name }}" class="book-image">
                            </a>
                        </div>
                        <div class="flex-grow-1 max-width-780">
                            <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="text-success underline-on-hover">
                                <h2 class="h4">{{ $record->name }}</h2>
                            </a>
                            <p class="lead mb-2 text-body-emphasis">
                                {{ \Carbon\Carbon::parse($record->date)->format('Y') }}
                                <span class="mx-2">&bull;</span>
                                {{ $record->summary }}
                            </p>
                            @if($record->focus->count() > 0)
                                <p class="lead mb-2 text-body-secondary">
                                    @foreach ($record->focus as $item)
                                        {{ $item->name }}@if (!$loop->last) / @endif
                                    @endforeach
                                </p>
                            @endif
                            <div class="max-width-780">
                                {{ $record->short_content_excerpt }}
                            </div>
                            <div class="d-flex flex-wrap ">
                                <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-0 mt-3 me-3">Buy Now</a>
                                <button type="button" class="btn btn-ghost-primary rounded-0 mt-3" data-bs-toggle="modal" data-bs-target="#details-{{ $record->id }}">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="details-{{ $record->id }}" tabindex="-1" aria-labelledby="details-label-details-{{ $record->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary-subtle">
                                    <h3 class="modal-title h5 mb-0 mt-1" id="details-label-details-{{ $record->id }}">{{ $record->name }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $record->content }}

                                    <div class="mt-3">
                                        <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="btn btn-accent text-white btn-lg">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div wire:key="empty" class="w-100">
                    <p class="lead mb-0">
                        No books match your search criteria.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $records->links() }}
        </div>
    </div>

</div>
