<div class="my-3 d-flex">
        <div>
            <x-livewire-filters.search label="Search by Identifier/Name" placeholder="Search" search="{{ $search }}" />
        </div>
    </div>
    <div class="mb-3">
        Showing {{ $records->count() }} of {{ $records->total() }} records
    </div>
    <table class="table table-striped align-middle">
        <thead>
            <tr class="h6">
                <th>Timestamp</th>
                <th>Type</th>
                <th>Status</th>
                <th>Stats</th>
                <th>Errors</th>
                <th>Company Messages</th>
                <th></th>
            </tr>
        </thead>
        @forelse($records as $record)
            <tr wire:key="record-{{ $record->id }}">
                <td class="text-nowrap">
                    {{ $record->formatted_created_at }}
                </td>
                <td class="text-nowrap">
                    {{ $record->type }}
                </td>
                <td class="text-nowrap">
                    <span wire:poll.visible>{{ $record->status }}</span>
                </td>
                <td class="text-nowrap small">
                    <div>
                        <span>{{ $record->rows }}</span>
                        <span>imported rows</span>
                    </div>
                    <div>
                        <span>{{ count($record->company_messages) }}</span>
                        <span>company messages</span>
                    </div>
                </td>
                <td>
                    @if($record->errors)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#errors-modal-{{ $record->id }}">
                           view errors
                       </button>

                        <div class="modal fade" id="errors-modal-{{ $record->id }}" tabindex="-1" aria-labelledby="errors-modal-{{ $record->id }}Label"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="errors-modal-{{ $record->id }}Label">Errors</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <pre>{{ print_r($record->errors, true) }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
                <td>
                    @if($record->company_messages)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#company-message-modal-{{ $record->id }}">
                           view data
                       </button>

                        <div class="modal fade" id="company-message-modal-{{ $record->id }}" tabindex="-1" aria-labelledby="company-message-modal-{{ $record->id }}Label"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="company-message-modal-{{ $record->id }}Label">Company Messages</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <pre>{{ print_r($record->company_messages, true) }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
                <td class="text-end">
                    <a href="{{ route('adminx.import.courses.show', $record->id) }}" class="btn btn-accent">fix errors</a>
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
