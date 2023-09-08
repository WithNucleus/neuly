<div>
    <div class="d-flex mb-4">
        <div>
            <x-livewire-filters.search label="Search" placeholder="Search" search="{{ $search }}" tooltip="Search by name or permission" />
        </div>
    </div>
    <table class="table w-auto table-hover align-middle">
        <thead class="text-uppercase fs-6">
            <tr>
                <th>Role</th>
                <th>Permissions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $role)
                <tr wire:key="role-{{ $role->id }}">
                    <td class="text-nowrap text-uppercase fw-bold">
                        <a href="{{ route('adminx.auth.roles-permissions.show', $role->id) }}">{{ $role->name }}</a>
                    </td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge text-body me-2 my-1 bg-light fw-normal">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
