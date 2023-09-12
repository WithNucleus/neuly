<div>
    <div class="d-lg-flex">
        <div class="pe-lg-5">
            <form wire:submit.prevent="save">
                <div class="mb-3 max-width-400">
                    <label for="name" class="fw-bold text-uppercase">Name</label>
                    <input wire:model="role.name" type="text" class="form-control" id="name">
                    @error('name') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="max-width-600 ps-lg-5">
            <p class="fw-bold text-uppercase mb-0">Permissions</p>
            <div class="row">
                @foreach($allPermissions as $permission)
                    <div wire:key="permission-item-{{ $permission->id }}" class="col-12 col-lg-6">
                        <div>
                            @if(in_array($permission->name, $permissions))
                                <button wire:click="removePermission('{{ $permission->id }}')" class="btn faux-select-item faux-select-item-hover-gray fs-normal">
                                    <i class="fa-sharp fa-solid fa-check fa-fw text-accent"></i>
                                    <span>{{ $permission->name }}</span>
                                </button>
                            @else
                                <button wire:click="addPermission('{{ $permission->id }}')" class="btn faux-select-item faux-select-item-hover-gray fs-normal">
                                    <i class="fa-sharp fa-regular fa-plus fa-fw"></i>
                                    <span>{{ $permission->name }}</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
