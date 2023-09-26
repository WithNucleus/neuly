<div>
    <div class="d-md-flex flex-wrap mt-4">

        <div class=" me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, entity, etc." />
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['type']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Type
                </button>
                <ul class="dropdown-menu" style="min-width: 250px">
                    @foreach ($typeOptions as $optionId => $optionName)
                        <li class="px-3">
                            <div class="form-check form-check-small form-check-inline">
                                <input wire:model="filters.type" class="form-check-input" type="checkbox" value="{{ $optionName }}"
                                       id="filter-type-{{ $optionId }}" @if(in_array($optionName, $filters['type'])) checked @endif>
                                <label class="form-check-label @if(in_array($optionName, $filters['type'])) fw-bold @endif" for="filter-type-{{ $optionId }}">
                                    <span>{{ $optionName }}</span>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
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
    <div class="table-responsive">
        <table class="table table-sm small table-hover align-middle">
            <thead class="text-uppercase fs-6 text-nowrap">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>CARE Record</th>
                    <th>Assigned</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="role-{{ $record->id }}">
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td class="text-nowrap">
                            <button wire:click="selectRecord('{{ $record->id }}')" class="btn btn-link text-decoration-none p-0">
                                @if($record->user)
                                    <div>
                                        {{ $record->user->fullname }}
                                        <span class="opacity-50">#{{ $record->user->id }}</span>
                                    </div>
                                @else
                                    <div>
                                        <span class="me-1">{{ $record->name }}</span>
                                        <span class="text-lowercase small">{{ $record->email }}</span>
                                    </div>
                                @endif
                            </button>
                        </td>
                        <td class="text-nowrap">{{ $record->type }}</td>
                        <td class="text-nowrap lead">
                            <span class="badge fw-normal text-uppercase {{ $record->status_color }}">{{ $record->status }}</span>
                        </td>
                        <td>
                            @if($record->entity)
                                <div>
                                    <a href="{{ $record->entity_link }}">
                                        <span class="truncate-300">
                                            {{ $record->entity->name }}
                                        </span>
                                    </a>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($record->assignee)
                                <span>{{ $record->assignee->full_name }}</span>
                            @endif
                        </td>
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


    <div wire:ignore.self class="modal fade" id="admin-dynamic-modal" tabindex="-1" aria-labelledby="admin-dynamic-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                @include('livewire.admin.care._selected-record-modal')
            </div>
        </div>
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
