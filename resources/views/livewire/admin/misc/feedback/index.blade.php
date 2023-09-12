<div>
    <div class="d-md-flex flex-wrap">

        <div class=" me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, role, etc." />
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['type']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Type
                </button>
                <ul class="dropdown-menu" style="min-width: 220px">
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
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Assigned</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr wire:key="role-{{ $record->id }}">
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td class="text-nowrap">
                            <button wire:click="selectFeedback('{{ $record->id }}')" class="btn btn-link p-0">{{ $record->title }}</button>
                        </td>
                        <td class="text-nowrap">{{ $record->type }}</td>
                        <td class="text-nowrap lead">
                            <span class="badge fw-normal text-uppercase {{ $record->status_color }}">{{ $record->status }}</span>
                        </td>
                        <td class="text-nowrap">
                            @if($record->user)
                                <div>
                                    {{ $record->user->fullname }}
                                    <span class="opacity-50">#{{ $record->user->id }}</span>
                                </div>
                            @else
                                <div>
                                    <span class="me-1">{{ $record->user_name }}</span>
                                    <a href="mailto:{{ $record->user_email }}">{{ $record->user_email }}</a>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($record->assignee)
                                <span>{{ $record->assignee->full_name }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div wire:ignore.self class="modal fade" id="admin-dynamic-modal" tabindex="-1" aria-labelledby="admin-dynamic-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if($selectedFeedback)
                    <div class="modal-header align-items-center">
                        <div class="h5 modal-title">{{ $selectedFeedback->title }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Date</div>
                                <div>{{ \Carbon\Carbon::parse($selectedFeedback->created_at)->format('M d, Y H:i') }}</div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Status</div>
                                <div class="lead">
                                    <span class="badge fw-normal text-uppercase {{ $selectedFeedback->status_color }}">{{ $selectedFeedback->status }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Type</div>
                                <div>{{ $selectedFeedback->type }}</div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">User</div>
                                <div>
                                    @if($selectedFeedback->user)
                                        <div>
                                            {{ $selectedFeedback->user->fullname }}
                                            <span class="opacity-50">#{{ $selectedFeedback->user->id }}</span>
                                        </div>
                                    @else
                                        <div>
                                            <span class="d-block">{{ $selectedFeedback->user_name }}</span>
                                            <a href="mailto:{{ $selectedFeedback->user_email }}">{{ $record->user_email }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($selectedFeedback->organization)
                                <div class="col-12 col-lg-6 mb-4">
                                    <div class="fw-bold text-uppercase text-primary">Organization</div>
                                    <div>{{ $selectedFeedback->organization }}</div>
                                </div>
                            @endif
                            @if($selectedFeedback->job_title)
                                <div class="col-12 col-lg-6 mb-4">
                                    <div class="fw-bold text-uppercase text-primary">Job Title</div>
                                    <div>{{ $selectedFeedback->job_title }}</div>
                                </div>
                            @endif
                        </div>
                        <div class="fw-bold text-uppercase text-primary">Message</div>
                        <div>{{ $selectedFeedback->content }}</div>

                        <div class="mt-5 border-top">
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                @foreach($statusActionOptions as $status => $details)
                                    @if($selectedFeedback->status !== $status)
                                        <button wire:click="changeStatus('{{ $status }}')" class="btn btn-{{ $details['button'] }} m-3">{{ $details['label'] }}</button>
                                    @endif
                                @endforeach
                            </div>
                            @if($selectedFeedback->status !== \App\Models\Feedback::STATUS_CLOSED)
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center mt-2">
                                        <label for="assignUser" class="text-uppercase fw-bold me-2 text-nowrap">Assigned to</label>
                                        <select wire:model="assignedUser" id="assignUser" class="form-select form-select-sm me-2">
                                            <option value=""></option>
                                            @foreach($internalUsers as $user)
                                                <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <button wire:click="assignFeedback" class="btn btn-sm btn-dark">Save</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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
