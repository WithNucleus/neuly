<div>
    @if(!$dashboard)
        <div class="d-flex flex-wrap justify-content-between align-items-end">
            <h1 class="my-2">Notifications</h1>
            <div class="my-2">
                <span class="me-3">Showing {{ $records->total() }} Notifications ({{ $unreadCount }} new)</span>
            </div>
        </div>
        <div class="my-3 d-flex">
            <div class="me-5">
                <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by keyword" />
            </div>
            <div>
                <x-livewire-filters.checkbox-single wireModel="hideRead" id="filter-featured" label="Hide read notifications" />
            </div>
        </div>
    @endif
    <div class="d-md-flex align-items-center mt-3">
        <div class="pb-4 ps-3 d-flex align-items-center">
            <div class="form-check lead me-4">
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
        <div class="ms-auto pb-4">
            <div wire:ignore class="dropdown">
                <button class="btn btn-outline-accent rounded-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bulk Actions
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a wire:click="markRead" class="dropdown-item" href="#">
                            <i class="fa-sharp fa-solid fa-envelope-circle-check fa-fw me-1"></i>
                            <span>Mark Selected as Read</span>
                        </a>
                    </li>
                    <li>
                        <a wire:click="markUnread" class="dropdown-item" href="#">
                            <i class="fa-kit fa-sharp-solid-envelopes-bulk-circle-exclamation fa-fw me-1"></i>
                            <span>Mark Selected as Unread</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="member-notifications-container">
        @forelse($records as $record)
            <div wire:key="notification-{{ $record->id }}" class="single-notification border bg-body mb-3 {{ ($record->was_read) ? 'read' : 'unread' }}">
                <div class="d-flex p-3" wire:click="selectNotification('{{ $record->id }}')">
                    <div class="pt-2">
                        <div class="form-check lead">
                            <input wire:model="selected" class="form-check-input" type="checkbox" value="{{ $record->id }}" id="select-{{ $record->id }}" aria-label="Select">
                        </div>
                    </div>
                    <div class="bookmark-image me-2 flex-shrink-0">
                        @if ($record->icon)
                            <img src="{{ asset('images/icons/' . $record->icon . '.svg') }}" alt="{{ $record->title}}">
                        @else
                            <img src="{{ asset('images/person-blank.png') }}" alt="{{ $record->title}}">
                        @endif
                    </div>
                    <div>
                        <div class="title fs-6">
                            {{ $record->title}}
                        </div>
                        <div class="message text-body-secondary">
                            {!! $record->message !!}
                        </div>
                        <div class="mt-1 text-body-secondary small">{{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y g:i a') }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div wire:key="empty-no-records" class="single-notification border bg-body mb-3">
                <div class="fs-6 p-3">
                    There are no more notifications for you.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center me-4 mt-4">
            <select wire:model="perPage" id="perPage" class="form-select">
                @if($dashboard)
                    <option value="5">5</option>
                @endif
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="250">250</option>
            </select>
            <label for="perPage" class="d-block fw-bold ms-2 flex-shrink-0">Per Page</label>
        </div>
        <div class="mt-4">
            {{ $records->links() }}
        </div>
    </div>
</div>
