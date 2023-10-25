<?php

namespace App\Http\Livewire\Admin\Entities\Forms;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class EditReport extends Component
{
    use WithFileUploads;

    public Report $report;

    public $image;

    public function rules() {
        return [
            'report.date' => 'required',
            'report.name' => 'required',
            'report.slug' => [
                'required',
                Rule::unique('reports', 'slug')->ignore($this->report)
            ],
            'report.status' => 'required',
            'report.excerpt' => 'nullable',
            'report.preview' => 'nullable',
            'report.aside' => 'nullable',
            'report.image' => 'nullable',
            'report.sticky' => 'required',
            'image' => 'nullable'
        ];
    }

    public function save() {
        $this->validate();

        if ($this->image) {
            $filename = 'report-' . $this->report->id . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/reports', $filename);
            $this->report->image = $filename;
        }

        $this->report->save();

        $this->dispatchBrowserEvent('toast-notification',  ['text' => $this->report->name . ' saved!', 'background' => 'bg-success']);
    }

    public function render()
    {
        return view('livewire.admin.entities.forms.edit-report');
    }
}
