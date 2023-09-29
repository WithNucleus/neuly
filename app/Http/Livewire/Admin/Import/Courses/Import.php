<?php

namespace App\Http\Livewire\Admin\Import\Courses;

use App\Http\Imports\Courses\CourseImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class Import extends Component
{
    use WithFileUploads;

    public $file;
    public ?string $success = null;
    public ?string $failure = null;

    public array $requiredFields = [
        'name' => 'string',
        'summary' => 'longText',
        'url' => 'string',
        'type' => 'string',
        'learning_location' => 'string',
        'delivery_method' => 'string',
        'lowest_cost' => 'integer',
        'highest_cost' => 'integer',
        'currency' => 'string',
        'education_credits' => 'string',
        'hours' => 'number',
        'awarded' => 'string',
        'next_date' => 'date (YYYY-MM-DD)',
        'next_date_string' => 'string',
        'finish_date' => 'date (YYYY-MM-DD)',
        'open_enrollment' => 'boolean (true = 1; false = 0)',
        'length' => 'string',
        'self_paced' => 'boolean (true = 1; false = 0)',
        'image' => 'string',
        'featured' => 'boolean (true = 1; false = 0)',
        'concierge' => 'boolean (true = 1; false = 0)',
    ];

    public function upload()
    {
        $this->validate([
            'file' => 'required|mimes:csv,xls,xlsx,application/vnd.ms-excel'
        ]);

        try {
            Excel::import(new CourseImport(), $this->file);
            $this->success = 'Successfully uploaded file';
            $this->reset('failure');
        } catch (Throwable $exception) {
            $this->failure = 'Error: ' . $exception->getMessage();
            $this->reset('success');
        }
    }

    public function render()
    {
        return view('livewire.admin.import.courses.import');
    }
}
