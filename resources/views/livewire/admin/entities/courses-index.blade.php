<div>
    <div class="d-md-flex flex-wrap mt-3">

        <div class="me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by title, NCT number, summary, etc." />
        </div>

        <div class="ms-auto mb-3">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>

    </div>
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="me-3">
            <div class="me-3">
                <strong>{{ number_format($records->total(), 0) }}</strong> total records
            </div>
            @if (!empty($selected))
                <div>
                    <strong>{{ count($selected) }}</strong> selected
                </div>
            @else
                <div>&nbsp;</div>
            @endif
        </div>
        <div wire:ignore class="dropdown">
            <button class="btn btn-primary rounded-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bulk Actions
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a wire:click="bulkAutoTag" class="dropdown-item" href="#">
                        <i class="fa-sharp fa-solid fa-tags fa-fw me-1"></i>Auto Tag
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="table-entity-index-container table-responsive">
        <table class="table align-middle">
            <thead class="text-uppercase">
                <tr>
                    <th>
                        <div class="form-check">
                            <input wire:model="selectPage" class="form-check-input" type="checkbox" value="selectAll"
                                   id="selectAll" aria-label="Select">
                        </div>
                    </th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Delivery Method</th>
                    <th>Cost</th>
                    <th>Currency</th>
                    <th>Credits</th>
                    <th>Hours</th>
                    <th>Dates</th>
                    <th>Open Enrollment</th>
                    <th>Self Paced</th>
                    <th>Length</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="record-{{ $record->slug }}" class="small">
                        <td>
                            <div class="form-check">
                                <input wire:model="selected" class="form-check-input" type="checkbox"
                                       value="{{ $record->id }}" id="select-{{ $record->id }}" aria-label="Select">
                            </div>
                        </td>
                        <td>
                            <div class="truncate-300">
                                <a href="{{ route('discover.courses.show', $record->slug) }}">{{ $record->name }}</a>
                            </div>
                        </td>
                        <td class="text-nowrap">{{ $record->type }}</td>
                        <td class="text-nowrap">{{ $record->learning_location }}</td>
                        <td class="text-nowrap">{{ $record->delivery_method }}</td>
                        <td class="text-nowrap">
                            @if($record->lowest_cost)
                                <span>{{ $record->lowest_cost }}</span>
                            @endif
                            @if($record->lowest_cost AND $record->highest_cost)
                                <span>&ndash;</span>
                            @endif
                            @if($record->highest_cost)
                                <span>{{ $record->highest_cost }}</span>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $record->currency }}</td>
                        <td class="text-nowrap">{{ $record->education_credits }}</td>
                        <td class="text-nowrap">{{ $record->hours }}</td>
                        <td class="text-nowrap">
                            @if($record->next_date)
                                <div>
                                    <strong>Start:</strong>
                                    <span>{{ $record->next_date }}</span>
                                </div>
                            @endif
                            @if($record->finish_date)
                                <div>
                                    <strong>Finish:</strong>
                                    <span>{{ $record->finish_date }}</span>
                                </div>
                            @endif
                            @if($record->next_date_string)
                                <div>
                                    <strong>Starting</strong>
                                    <span>{{ $record->next_date_string }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            @if($record->open_enrollment === 1)
                                <span>Yes</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            @if($record->self_paced === 1)
                                <span>Yes</span>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $record->length }}</td>
                        <td>{{ $record->image }}</td>
                    </tr>
                @empty
                    <tr wire:key="empty-no-records">
                        <td colspan="99">No records match your query</td>
                    </tr>
                 @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between mt-5">
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

        {{ $records->links() }}
    </div>
</div>
