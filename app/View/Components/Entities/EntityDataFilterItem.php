<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityDataFilterItem extends Component
{
    public array $filters;
    public string $key;
    public string $label;

    public function __construct(array $filters, string $key, string $label)
    {
        $this->filters = $filters;
        $this->key = $key;
        $this->label = $label;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.entity-data-filter-item');
    }
}
