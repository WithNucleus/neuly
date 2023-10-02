@if($selectedRecord)
    <div class="modal-header align-items-center">
        <div class="h5 modal-title">{{ $selectedRecord->name }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
        <div>
            <strong>IP Address:</strong>
            <span>{{ $selectedRecord->ip }}</span>
        </div>
        @if($selectedRecord->user)
            <div>
                <strong>User:</strong>
                <span>{{ $selectedRecord->user->fullname }}</span>
                <span class="opacity-50">#{{ $selectedRecord->user->id }}</span>
            </div>
        @endif
        <div class="mt-4 small">
            <pre>{{ print_r($selectedRecord->data, true) }}</pre>
        </div>
    </div>
@endif
