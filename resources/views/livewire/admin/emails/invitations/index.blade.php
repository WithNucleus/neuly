<div>
    <div class="d-md-flex flex-wrap mt-4">

        <div class="me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, etc." />
        </div>

        <div class="me-md-4 mb-3">
            <x-livewire-filters.checkbox-single wireModel="filters.registered" id="filter-registered" label="Registered" />
        </div>

        <div class="filter-widget ms-auto">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
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
                    <a wire:click="replaceMergeValues" class="dropdown-item" href="#">
                        <i class="fa-sharp fa-solid fa-code fa-fw me-1"></i>Replace merge values
                    </a>
                </li>
                <li>
                    <a wire:click="deleteRecords" class="dropdown-item" href="#">
                        <i class="fa-sharp fa-solid fa-trash fa-fw me-1"></i>Delete un-sent emails
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover small align-middle">
            <thead class="text-uppercase fs-6 text-nowrap">
                <tr>
                    <th style="width: 32px"></th>
                    <th>
                        <x-entities.entity-index-sort-button label="Created" field="created_at" :sorts="$sorts" buttonClasses="fs-6 fw-bold p-0" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>Name</th>
                    <th>
                        <x-entities.entity-index-sort-button label="Email" field="email_preference_email" :sorts="$sorts" buttonClasses="fs-6 fw-bold p-0" inactiveClasses="text-body" activeClasses="text-accent" />
                    </th>
                    <th>
                        <span class="fs-6 fw-bold">Inviter</span>
                    </th>
                    <th>
                        <span class="fs-6 fw-bold">Invitee</span>
                    </th>
                    <th>
                        <span class="fs-6 fw-bold">Journey</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="record-{{ $record->id }}">
                        <td>
                            <div class="form-check">
                                <input wire:model="selected" class="form-check-input" type="checkbox" value="{{ $record->id }}" id="select-{{ $record->id }}" aria-label="Select">
                            </div>
                        </td>
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td class="text-nowrap">{{ $record->emailPreference->full_name }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('adminx.emails.preferences.show', $record->email_preference_email) }}">{{ $record->email_preference_email }}</a>
                        </td>
                        <td class="text-nowrap">
                            @if($record->inviter)
                                <span class="text-body-tertiary">#{{ $record->inviter->id }}</span>
                                <span>{{ $record->inviter->full_name }}</span>
                            @endif
                        </td>
                        <td>
                            @if($record->invitee)
                                <span class="text-body-tertiary">#{{ $record->invitee->id }}</span>
                                <span>{{ $record->invitee->full_name }}</span>
                            @endif
                        </td>
                        <td>
                            @if($record->emailJourney)
                                <span>{{ $record->emailJourney->name }}</span>
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
