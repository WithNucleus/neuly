<?php

namespace App\Http\Livewire\Admin\Import\Courses;

use App\Http\Imports\Courses\CompanyRelationshipImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CompanyImport extends Component
{
    use WithFileUploads;

    public $file;
    public ?string $success = null;
    public ?string $failure = null;

    public array $requiredFields = [
        'name' => 'string',
        'company_name' => 'string',
    ];

    public array $optionalFields = [
        'company_url' => 'string',
    ];

    public function upload()
    {
        $this->validate([
            'file' => 'required|mimes:csv, xls, xlsx'
        ]);

        try {
            Excel::import(new CompanyRelationshipImport(), $this->file);
            $this->success = 'Successfully uploaded file';
            $this->reset('failure');
        } catch (Throwable $exception) {
            $this->failure = 'Error: ' . $exception->getMessage();
            $this->reset('success');
        }
    }

    public function render()
    {
        return view('livewire.admin.import.courses.company-import');
    }
}
