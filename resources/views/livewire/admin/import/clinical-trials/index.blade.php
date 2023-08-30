<div>
    <div class="my-3 d-flex">
        <div>
            <x-livewire-filters.search label="Search by Identifier/Name" placeholder="Search" search="{{ $search }}" />
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
                    <span>{{ $record->data['protocolSection']['identificationModule']['briefTitle'] }}</span>
                </td>
                <td class="text-nowrap">
                    {{ $record->status }}
                </td>
                <td class="text-nowrap pe-5">
                    <livewire:admin.import.clinical-trials.match-entity wire:key="record-{{ $record->id }}" :importedEntity="$record" />
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
