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
                <ul class="dropdown-menu" style="min-width: 240px">
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
                    <th>EDU Record</th>
                    <th>Assigned</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="role-{{ $record->id }}">
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td class="text-nowrap">
                            <button wire:click="selectStudent('{{ $record->id }}')" class="btn btn-link text-decoration-none p-0">
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
                                    <a href="{{ $record->entity_link }}">{{ $record->entity->name }}</a>
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
                @if($selectedStudent)
                    <div class="modal-header align-items-center">
                        <div class="h5 modal-title">{{ $selectedStudent->name }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Date</div>
                                <div>{{ \Carbon\Carbon::parse($selectedStudent->created_at)->format('M d, Y H:i') }}</div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Status</div>
                                <div class="lead">
                                    <span class="badge fw-normal text-uppercase {{ $selectedStudent->status_color }}">{{ $selectedStudent->status }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Type</div>
                                <div>{{ $selectedStudent->type }}</div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">User</div>
                                <div>
                                    @if($selectedStudent->user)
                                        <div>
                                            {{ $selectedStudent->user->fullname }}
                                            <span class="opacity-50">#{{ $selectedStudent->user->id }}</span>
                                            <div>
                                                <a href="mailto:{{ $selectedStudent->user->email }}">{{ $selectedStudent->user->email }}</a>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div>
                                                <span>{{ $selectedStudent->name }}</span>
                                                <span class="opacity-50 small">(unregistered)</span>
                                            </div>
                                            <div>
                                                <a href="mailto:{{ $selectedStudent->email }}">{{ $selectedStudent->email }}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    @if($selectedStudent->phone)
                                        <a href="tel:{{ $selectedStudent->phone }}">{{ $selectedStudent->phone }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="fw-bold text-uppercase text-primary">Location</div>
                                @isset($selectedStudent->data['locations'])
                                    <div>
                                        {{ $selectedStudent->data['locations']['local']['name'] }}
                                    </div>
                                    <div class="small">
                                        @isset($selectedStudent->data['locations']['local'])
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $selectedStudent->data['locations']['local']['latitude'] }},{{ $selectedStudent->data['locations']['local']['longitude'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                {{ $selectedStudent->data['locations']['local']['latitude'] }}, {{ $selectedStudent->data['locations']['local']['longitude'] }}
                                            </a>
                                        @endisset
                                    </div>
                                @endisset
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                @isset($selectedStudent->data['filters'])
                                    <div class="fw-bold text-uppercase text-primary">Search Intent</div>
                                    <div class="row">
                                        @if(!empty($selectedStudent->data['filters']['type']))
                                            <div class="col-12 col-xl-6 small mb-2">
                                                <div class="fw-bold text-uppercase">Type</div>
                                                @foreach($selectedStudent->data['filters']['type'] as $item)
                                                    <div>{{ $item }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if(!empty($selectedStudent->data['filters']['focus']))
                                            <div class="col-12 col-xl-6 small mb-2">
                                                <div class="fw-bold text-uppercase">Focus</div>
                                                @foreach($selectedStudent->data['filters']['focus'] as $item)
                                                    <div>{{ $item }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if(!empty($selectedStudent->data['filters']['delivery-method']))
                                            <div class="col-12 col-xl-6 small mb-2">
                                                <div class="fw-bold text-uppercase">Delivery Method</div>
                                                @foreach($selectedStudent->data['filters']['delivery-method'] as $item)
                                                    <div>{{ $item }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if(!empty($selectedStudent->data['filters']['companies']))
                                            <div class="col-12 col-xl-6 small mb-2">
                                                <div class="fw-bold text-uppercase">Companies</div>
                                                @foreach($selectedStudent->data['filters']['companies'] as $item)
                                                    <div>{{ $item }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-12 col-xl-6 small mb-2">
                                            @if($selectedStudent->data['filters']['free'])
                                                <div>
                                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                                    <span>Free</span>
                                                </div>
                                            @endif
                                            @if($selectedStudent->data['filters']['self-paced'])
                                                <div>
                                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                                    <span>Self Paced</span>
                                                </div>
                                            @endif
                                            @if($selectedStudent->data['filters']['open-enrollment'])
                                                <div>
                                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                                    <span>Open Enrollment</span>
                                                </div>
                                            @endif
                                            @if($selectedStudent->data['filters']['education-credits'])
                                                <div>
                                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                                    <span>Education Credits</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="fw-bold text-uppercase text-primary">Message</div>
                        <div>{{ $selectedStudent->message }}</div>

                        <div class="mt-5 border-top">
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                @foreach($statusActionOptions as $status => $details)
                                    @if($selectedStudent->status !== $status)
                                        <button wire:click="changeStatus('{{ $status }}')" class="btn btn-{{ $details['button'] }} m-3">{{ $details['label'] }}</button>
                                    @endif
                                @endforeach
                            </div>
                            @if($selectedStudent->status !== \App\Models\Feedback::STATUS_CLOSED)
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center mt-2">
                                        <label for="assignUser" class="text-uppercase fw-bold me-2 text-nowrap">Assigned to</label>
                                        <select wire:model="assignedUser" id="assignUser" class="form-select form-select-sm me-2">
                                            <option value=""></option>
                                            @foreach($internalUsers as $user)
                                                <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <button wire:click="assignStudent" class="btn btn-sm btn-dark">Save</button>
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
