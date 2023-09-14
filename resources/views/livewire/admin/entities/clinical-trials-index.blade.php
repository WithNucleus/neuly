<div>
    <div class="d-md-flex flex-wrap mt-3">

        <div class="me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by title, NCT number, summary, etc." />
        </div>

        <div class="me-md-5 mb-3">
            <x-livewire-filters.checkbox-single class="lead" wireModel="filters.not-imported" id="filters.not-imported" label="Not Imported" />
        </div>

        <div class="ms-auto mb-3">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>

    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
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
                    <a wire:click="importTrials" class="dropdown-item" href="#">Import Trials</a>
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
                    <th>NCT Number</th>
                    <th>Imported</th>
                    <th>Title</th>
                    <th>Focus</th>
                    <th>Phase</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="record-{{ $record->id }}" class="small">
                        <td>
                            <div class="form-check">
                                <input wire:model="selected" class="form-check-input" type="checkbox"
                                       value="{{ $record->id }}" id="select-{{ $record->id }}" aria-label="Select">
                            </div>
                        </td>
                        <td>{{ $record->nct_number }}</td>
                        <td>
                            @if($record->imported)
                                <div>
                                    <i class="fa-sharp fa-solid fa-check text-accent"></i>
                                    <span>{{ $record->imported->updated_at }}</span>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="max-width-400">
                                <a href="{{ route('discover.clinicaltrials.show', $record->slug) }}">
                                    {{ $record->title }}
                                </a>
                            </div>
                        </td>
                        <td>
                            @foreach($record->focus as $focus)
                                <div>{{ $focus->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($record->phases as $phase)
                                <div>{{ $phase->pretty_name }}</div>
                            @endforeach
                        </td>
                        <td>{{ $record->status }}</td>
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
