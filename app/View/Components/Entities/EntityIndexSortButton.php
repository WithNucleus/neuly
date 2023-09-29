<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityIndexSortButton extends Component
{
    public string $label;
    public string $field;
    public array $sorts;
    public ?string $buttonClasses;
    public ?string $inactiveClasses;
    public ?string $activeClasses;

    public function __construct(string $label, string $field, array $sorts, ?string $buttonClasses = null, ?string $inactiveClasses = null, ?string $activeClasses = null)
    {
        $this->label = $label;
        $this->field = $field;
        $this->sorts = $sorts;
        $this->buttonClasses = $buttonClasses;
        $this->inactiveClasses = $inactiveClasses;
        $this->activeClasses = $activeClasses;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.entity-index-sort-button');
    }
}
