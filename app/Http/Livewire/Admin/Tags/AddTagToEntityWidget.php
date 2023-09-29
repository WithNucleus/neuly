<?php

namespace App\Http\Livewire\Admin\Tags;

use App\Models\Focus;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class AddTagToEntityWidget extends Component
{
    public bool $success = false;
    public bool $error = false;
    public $selectedTag;
    public Model $model;

    public function saveTag() {
        if ($this->selectedTag == '') {
            $this->error = true;
            $this->success = false;
        } else {
            $this->error = false;
            $this->model->focus()->syncWithoutDetaching($this->selectedTag);
            $this->success = true;
        }
    }

    public function render()
    {
        return view('livewire.admin.tags.add-tag-to-entity-widget', [
            'tags' => Focus::drugs()->orderBy('name')->get()
        ]);
    }
}
