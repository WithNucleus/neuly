<?php

namespace App\View\Components\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class DataModalWithButton extends Component
{
    public string $uniqueId;
    public Model $model;
    public string $field;
    public string $buttonLabel;

    public function __construct(string $uniqueId, Model $model, string $field, string $buttonLabel)
    {
        $this->uniqueId = $uniqueId;
        $this->model = $model;
        $this->field = $field;
        $this->buttonLabel = $buttonLabel;
    }

    public function render()
    {
        return view('components.entities.data-modal-with-button');
    }
}
