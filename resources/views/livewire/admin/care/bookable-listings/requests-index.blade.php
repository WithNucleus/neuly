<div>
    <div class="d-md-flex flex-wrap">

        <div class=" me-md-5 mb-3">
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name, email, role, etc." />
        </div>

        <div class="filter-widget ms-auto">
            <button wire:click="clearFilters" class="btn btn-sm btn-dark rounded-0">Clear Filters</button>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table small table-hover align-middle">
            <thead class="text-uppercase fs-6 text-nowrap">
                <tr>
                    <th>Date</th>
                    <th>Listing</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr wire:key="role-{{ $record->id }}">
                        <td class="text-nowrap">{{ Carbon\Carbon::parse($record->created_at)->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('discover.bookable-listing.show', $record->bookableListing->slug) }}">
                                {{ $record->bookableListing->name }}
                            </a>
                        </td>
                        <td>
                            {{ $record->user->full_name }}
                        </td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->phone }}</td>
                        <td>
                            @if($record->message)
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#details-modal-{{ $record->id }}">
                                    view message
                                </button>

                                <div class="modal fade" id="details-modal-{{ $record->id }}" tabindex="-1" aria-labelledby="details-modal-{{ $record->id }}Label"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5" id="exampleModalLabel">Message from {{ $record->user->full_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $record->message }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
