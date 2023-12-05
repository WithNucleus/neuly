<?php

namespace App\Http\Livewire\Admin\Entities\Relationships;

use App\Models\CourseProgram;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CoursePrograms extends Component
{
    use WithPagination;

    public ?string $name = null;

    public function rules() {
        return [
            'name' => [
                'required',
                Rule::unique('course_programs', 'name')
            ]
        ];
    }

    public function submit() {
        $this->validate();

        CourseProgram::create([
           'name' => $this->name
        ]);

        $this->dispatchBrowserEvent('toast-notification',  ['text' => $this->name . ' added!', 'background' => 'bg-success']);

        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.admin.entities.relationships.course-programs', [
            'coursePrograms' => CourseProgram::paginate(10)
        ]);
    }
}
