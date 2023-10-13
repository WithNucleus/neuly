<div>
    <div class="my-3">
        <button wire:click="toggleForm" class="btn btn-sm btn-primary">Manage emails</button>
    </div>
    <div class="max-width-600">
        @if($showForm)
            <div>
                <table class="table border align-middle">
                    @forelse($trigger->adminUsers as $user)
                        <tr>
                            <th class="text-body-emphasis">#{{ $user->id }}</th>
                            <td>{{ $user->full_name }}</td>
                            <td class="text-body-secondary">{{ $user->email }}</td>
                            <td class="text-end">
                                <button wire:click="removeUser('{{ $user->id }}')" class="btn text-danger">
                                    <i class="fa-sharp fa-regular fa-xmark-large"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3">
                            <div class="text-danger fs-6">No admin emails set!</div>
                        </td>
                    @endforelse
                </table>
                <div class="border p-3 mb-3">
                    <label class="fw-bold text-uppercase" for="search">Add a User</label>
                    <input wire:model="search" class="form-control" id="search" placeholder="Search for user">

                    @if($search)
                        <div class="faux-search-box-container">
                            <div class="faux-search-box-results">
                                <ul class="list-group list-group-flush">
                                    @forelse($this->userSearchResults as $result)
                                        <li class="list-group-item list-group-item-action p-0">
                                            <button wire:click="assignUser('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                                <span>#{{ $result['id'] }}</span>
                                                <span>{{ $result['name'] }} {{ $result['last_name'] }}</span>
                                                <span class="d-block small text-body-tertiary">{{ $result['email'] }}</span>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            No matches for your search
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
