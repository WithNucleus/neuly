<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityIndexSortButton extends Component
{
    public string $label;
    public string $field;
    public array $sorts;

    public function __construct($label, $field, $sorts)
    {
        $this->label = $label;
        $this->field = $field;
        $this->sorts = $sorts;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.entity-index-sort-button');
    }
}
