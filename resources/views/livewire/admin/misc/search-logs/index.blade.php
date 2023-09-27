<div>
    <div class="d-md-flex flex-wrap">

        <div class="me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, role, etc." />
        </div>

        <div class="filter-widget me-md-5 mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-md @if($filters['type']) btn-accent @else btn-primary @endif btn-primary dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Type
                </button>
                <ul class="dropdown-menu" style="min-width: 300px">
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

        <div class="me-md-5 mb-3">
            <x-livewire-filters.checkbox-single wireModel="filters.has-keyword" id="filter-has-keyword" label="Has Keyword" />
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
                    <th>User</th>
                    <th>Type</th>
                    <th>Keyword</th>
                    <th>Filters</th>
                    <th>Entity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr wire:key="role-{{ $record->id }}">
                        <td class="text-nowrap">{{ $record->created_at }}</td>
                        <td>
                            <div>
                                <strong>IP:</strong>
                                <span>{{ $record->ip }}</span>
                            </div>
                            <div>
                                @if($record->user)
                                    <div>
                                        {{ $record->user->fullname }}
                                        <span class="opacity-50">#{{ $record->user->id }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>{{ $record->type }}</td>
                        <td>
                            <div class="max-width-400">
                                @if($record->term !== 'empty')
                                    <span>{{ $record->term }}</span>
                                @else
                                    <span>&ndash;</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @isset($record->data['filters'])
                                <button wire:click="selectRecord('{{ $record->id }}')" class="btn btn-link text-decoration-none p-0">
                                    View Filters
                                </button>
{{--                                <x-entities.entity-data-filter-item :filters="$record->data['filters']" key="sex" label="Sex" />--}}
{{--                                <x-entities.entity-data-filter-item :filters="$record->data['filters']" key="min_age" label="Min Age" />--}}
{{--                                <x-entities.entity-data-filter-item :filters="$record->data['filters']" key="max_age" label="Max Age" />--}}
{{--                                <x-entities.entity-data-filter-item :filters="$record->data['filters']" key="locations" label="Locations" />--}}
{{--                                <x-entities.entity-data-filter-item :filters="$record->data['filters']" key="conditions" label="Conditions" />--}}
                            @endisset
                        </td>
                        <td>
                            @if($record->relatable)
                                <span class="truncate-300">{{ $record->relatable->name }}</span>
                            @endif
                        </td>
                    </tr>
               @endforeach
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

     <div wire:ignore.self class="modal fade" id="admin-dynamic-modal" tabindex="-1" aria-labelledby="admin-dynamic-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                @include('livewire.admin.misc.search-logs._selected-record-modal')
            </div>
        </div>
    </div>
</div>
