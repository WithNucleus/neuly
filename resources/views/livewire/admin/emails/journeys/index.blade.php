<div>
    <div class="d-md-flex flex-wrap mt-4">

        <div class=" me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, etc." />
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['status']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Status
                </button>
                <ul class="dropdown-menu" style="min-width: 220px">
                    @foreach ($statusOptions as $optionId => $optionName)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.status" class="form-check-input" type="checkbox" value="{{ $optionName }}"
                                       id="filter-status-{{ $optionId }}" @if(in_array($optionName, $filters['status'])) checked @endif>
                                <label class="form-check-label @if(in_array($optionName, $filters['status'])) fw-bold @endif" for="filter-status-{{ $optionId }}">
                                    <span>{{ ucwords($optionName) }}</span>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="filter-widget ms-auto">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="mb-3">
            <strong>{{ number_format($records->total(), 0) }}</strong> total records
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-uppercase fs-6 text-nowrap">
                <tr>
                    <th>
                        <x-entities.entity-index-sort-button label="Created" field="created_at" :sorts="$sorts" buttonClasses="fs-6 fw-bold p-0" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>
                        <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" buttonClasses="fs-6 fw-bold p-0" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>
                        Sequences
                    </th>
                    <th>
                        <x-entities.entity-index-sort-button label="Status" field="status" :sorts="$sorts" buttonClasses="fs-6 fw-bold p-0" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="record-{{ $record->id }}">
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('adminx.emails.journeys.show', $record->id) }}">{{ $record->name }}</a>
                            <div class="text-body-secondary">{{ $record->description }}</div>
                        </td>
                        <td>
                            @foreach($record->emailSequences as $sequence)
                                <div class="small">
                                    <span class="me-2">{{ $sequence->name }}</span>
                                    <span class="text-body-tertiary">{{ $sequence->delay }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td class="text-nowrap">{{ $record->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="99">
                            <div class="lead">No records match your criteria</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-wrap align-items-center justify-content-between mt-5">
        <div class="d-flex align-items-center me-4">
            <select wire:model="perPage" id="perPage" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="250">250</option>
            </select>
            <label for="perPage" class="d-block fw-bold ms-2 flex-shrink-0">Per Page</label>
        </div>
        <div>
            {{ $records->links() }}
        </div>
    </div>
</div>
