<div>
    <div class="my-3 d-flex">
        <div class="me-5">
            <x-livewire-filters.search label="Search by Identifier/Name" placeholder="Search" search="{{ $search }}" />
        </div>

        <div class="me-5">
            <x-livewire-filters.checkbox-single class="lead" wireModel="filters.has-entity" id="filters.has-entity" label="Needs Syncing" />
        </div>

        <div>
            <x-livewire-filters.checkbox-single class="lead" wireModel="filters.has-errors" id="filters.has-errors" label="Has Errors" />
        </div>
    </div>
    <div class="mb-3">
        Showing {{ $records->count() }} of {{ $records->total() }} records
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Imported</th>
                <th>Last Updated</th>
                <th>Identifier/Name</th>
                <th class="min-width-120">Status</th>
                <th class="min-width-120">Entity</th>
                <th>Errors</th>
                <th></th>
            </tr>
        </thead>
        @forelse($records as $record)
            <tr wire:key="record-{{ $record->id }}">
                <td class="text-nowrap">
                    {{ $record->formatted_created_at }}
                </td>
                <td class="text-nowrap">
                    {{ $record->formatted_updated_at }}
                </td>
                <td>
                    <strong class="d-block">{{ $record->name }}</strong>
                    <div class="max-width-600">{{ $record->data['protocolSection']['identificationModule']['briefTitle'] }}</div>
                </td>
                <td class="text-nowrap">
                    {{ $record->status }}
                </td>
                <td class="text-nowrap pe-5">
                    <livewire:admin.import.clinical-trials.match-entity wire:key="record-{{ $record->id }}" :importedEntity="$record" />
                </td>
                <td>
                    @if($record->errors)
                        <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                data-bs-target="#errors-modal-{{ $record->id }}">
                            <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                        </button>

                        <div class="modal fade" id="errors-modal-{{ $record->id }}" tabindex="-1" aria-labelledby="errors-modal-{{ $record->id }}Label"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="errors-modal-{{ $record->id }}Label">Errors for {{ $record->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="px-3 py-4">
                                            <table class="table table-bordered">
                                                @foreach($record->errors as $label => $value)
                                                    <tr>
                                                        <th class="text-uppercase">{{ $label }}</th>
                                                        <td>{{ $value }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
                <td class="text-end">
                    <x-entities.data-modal-with-button uniqueId="clinical-trial-import-{{ $record->id }}" :model="$record" field="data" buttonLabel="view data" />
                </td>
            </tr>
        @empty
            <tr wire:key="empty">
                <td colspan="99">No records match your query</td>
            </tr>
        @endforelse
    </table>
    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
