<?php

namespace App\Http\Livewire\Admin\Import\Users;

use App\Imports\Users\InviteUsersImport;
use App\Models\EmailJourney;
use App\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class InviteUsers extends Component
{
    use WithFileUploads;

    public $file;
    public ?string $journey = null;
    public ?string $inviter = null;

    public ?string $success = null;
    public ?string $failure = null;

    public string $uniqueField = 'name';

    public array $requiredFields = [
        'email' => 'string',
    ];

    public array $optionalFields = [
        'first_name' => 'string',
        'last_name' => 'string',
        'source' => 'string',
    ];

    public function upload()
    {
        $this->validate([
            'file' => 'required|mimes:csv,xls,xlsx,application/vnd.ms-excel',
            'inviter' => 'required',
            'journey' => 'nullable'
        ]);

        try {
            Excel::import(new InviteUsersImport($this->journey, $this->inviter), $this->file);
            $this->success = 'Successfully uploaded file';
            $this->reset('failure');
        } catch (Throwable $exception) {
            $this->failure = 'Error: ' . $exception->getMessage();
            $this->reset('success');
        }
    }

    public function render()
    {
        return view('livewire.admin.import.users.invite-users', [
            'journeyTypeOptions' => EmailJourney::JOURNEYS_WITH_AUTOMATION,
            'userOptions' => User::whereHas('roles', function($query) {
                $query->whereIn('name', ['Admin', 'Editor']);
            })->get()
        ]);
    }
}
