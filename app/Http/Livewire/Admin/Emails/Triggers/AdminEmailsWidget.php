<?php

namespace App\Http\Livewire\Admin\Emails\Triggers;

use App\Models\EmailTrigger;
use App\User;
use Livewire\Component;

class AdminEmailsWidget extends Component
{
    public EmailTrigger $trigger;

    public bool $showForm = false;
    public ?string $search = null;
    public array $userSearchResults = [];

    public function updatedSearch($value) {
        if($this->search) {
            $this->userSearchResults = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->get()
                ->toArray();
        } else {
            $this->userSearchResults = [];
        }
    }

    public function toggleForm() {
        $this->showForm = !$this->showForm;
    }

    public function assignUser($id) {
        $this->trigger->adminUsers()->syncWithoutDetaching([$id]);
        $this->trigger->refresh();
        $this->reset('search');
        $this->reset('userSearchResults');
    }

    public function removeUser($id) {
        $this->trigger->adminUsers()->detach($id);
        $this->trigger->refresh();
    }

    public function render()
    {
        return view('livewire.admin.emails.triggers.admin-emails-widget');
    }
}
