<div>
    <div class="d-flex flex-wrap mb-3">
        <div class="my-4 me-5 d-flex align-items-center max-width-360 flex-grow-1">
            <input wire:model="search" type="text" class="form-control flex-grow-1 me-1" placeholder="Search">
            <div style="width: 1.5rem">
                @if($search)
                    <button wire:click="clearSearch" class="btn text-danger px-1 border-0" aria-label="Clear search"><i class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                @endif
            </div>
        </div>
        <div class="my-4 me-5">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['focus']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0 min-width-200" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Focus
                </button>
                <ul class="dropdown-menu" style="min-width: 220px">
                    @foreach ($focusOptions as $option)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.focus" class="form-check-input" type="checkbox" value="{{ $option['name'] }}"
                                       id="filter-focus-{{ $option['slug'] }}" @if(in_array($option['name'], $filters['focus'])) checked @endif>
                                <label class="form-check-label @if(in_array($option['name'], $filters['focus'])) fw-bold @endif" for="filter-focus-{{ $option['slug'] }}">
                                    {{ $option['name'] }} ({{ $option['reports_count'] }})
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($filters['focus'] OR $search)
            <div class="my-4 me-5">
                <button wire:click="clearFilters" class="btn text-body-secondary rounded-0">Clear Filters</button>
            </div>
        @endif
        <div class="ms-auto">
            <div class="my-4 fs-6 text-uppercase">
                <strong>{{ number_format($records->total(), 0) }}</strong> reports
            </div>
        </div>
    </div>
    <div class="entity-index-listings">
        <div class="row">
            @forelse($records as $record)
                <div class="col-12 col-md-6 mb-5">
                    <a href="{{ route('discover.industry-reports.show', $record->slug) }}" class="industry-report-card card-hover h-100">
                        <div>
                            <img src="{{ $record->entityImageUrl }}" alt="{{ $record->name }}">
                        </div>
                        <div class="content text-start">
                            <div class="mb-2">
                                <h2 class="h4 text-primary">{{ $record->name }}</h2>
                                <div class="text-body">{{ $record->excerpt }}</div>
                                <p class="post-meta text-body-secondary text-uppercase mt-3">
                                    <span class="date">{{ \Carbon\Carbon::parse($record->date)->format('M j, Y') }}</span>
                                    <span class="mx-1">&bull;</span>
                                    <span class="read-time">{{ $record->reading_time }}</span>
                                </p>
                            </div>
                            <div>
                                @foreach($record->focus as $focus)
                                    <span class="badge bg-body-tertiary text-body me-1 mt-1">{{ $focus->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="fs-5 py-4">
                        No reports match your query. Email us for a custom report.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="d-flex justify-content-center m-5">
        {{ $records->links() }}
    </div>
</div>
