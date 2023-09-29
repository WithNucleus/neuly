<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    public Role $role;
    public array $permissions = [];

    public function mount() {
        $this->getCurrentPermissions();
    }

    private function getCurrentPermissions() {
        $this->role->refresh();
        $this->permissions = $this->role->permissions->pluck('name', 'id')->toArray();
    }

    protected $rules = [
        'role.name' => 'required|string',
    ];

    public function save()
    {
        $this->validate();
        $this->role->save();
        $this->dispatchBrowserEvent('toast-notification',  ['text' => $this->role->name . ' role saved!', 'background' => 'bg-success']);
    }

    public function addPermission($permissionId) {
        $this->role->permissions()->syncWithoutDetaching([$permissionId]);
        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Permission saved!', 'background' => 'bg-success']);
        $this->getCurrentPermissions();
    }

    public function removePermission($permissionId) {
        $this->role->permissions()->detach($permissionId);
        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Permission removed!', 'background' => 'bg-danger']);
        $this->getCurrentPermissions();
    }

    public function render()
    {
        return view('livewire.admin.auth.edit-role', [
            'allPermissions' => Permission::orderBy('name')->get()
        ]);
    }
}
