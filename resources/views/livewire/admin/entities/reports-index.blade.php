<div>
    <div class="d-md-flex flex-wrap mt-3">

        <div class="me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by keyword or focus" />
        </div>

        <div class="ms-auto mb-3">
            <button wire:click="syncWordpress" class="btn bg-body-secondary text-body-emphasis rounded-0">Sync Reports</button>
        </div>

    </div>
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <div class="mb-3">
                <strong>{{ number_format($records->total(), 0) }}</strong> total records
            </div>
            <div class="ps-2 d-flex align-items-center">
                <div class="form-check me-4">
                    <input wire:model="selectPage" class="form-check-input" type="checkbox" id="select-page" aria-label="Select">
                    @if($selectAll)
                        <label for="select-page" class="ps-2"><strong>{{ $records->total() }}</strong> selected</label>
                    @else
                        <label for="select-page" class="ps-2"><strong>{{ count($selected) }}</strong> selected</label>
                    @endif
                </div>
                <div class="me-4">
                    @if ($selectPage)
                        @unless ($selectAll)
                            <div>
                                <button wire:click="selectAll" class="btn btn-link p-0">Select everything?</button>
                            </div>
                        @else

                        @endif
                    @endif
                </div>
            </div>
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
                            <input wire:model="selectPage" class="form-check-input" type="checkbox" value="selectAll" id="selectAll" aria-label="Select">
                        </div>
                    </th>
                    <th>
                        <x-entities.entity-index-sort-button label="Date" field="date" :sorts="$sorts" buttonClasses="p-0 fw-bold" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>
                        <x-entities.entity-index-sort-button label="Name" field="name" :sorts="$sorts" buttonClasses="p-0 fw-bold" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>
                        <x-entities.entity-index-sort-button label="Status" field="status" :sorts="$sorts" buttonClasses="p-0 fw-bold" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>Focus</th>
                    <th></th>
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
                        <td>{{ $record->date }}</td>
                        <td>
                            <a href="{{ route('discover.industry-reports.show', $record->slug) }}">{{ $record->name }}</a>
                        </td>
                        <td>{{ $record->status }}</td>
                        <td>
                            @foreach($record->focus as $focus)
                                <span class="badge bg-body-tertiary text-body">{{ $focus->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('adminx.reports.edit', $record->id) }}" class="btn btn-sm btn-accent rounded-0">edit</a>
                        </td>
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
