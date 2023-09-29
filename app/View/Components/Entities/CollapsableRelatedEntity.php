<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class CollapsableRelatedEntity extends Component
{
    public string $collapsableId;
    public string $label;

    public function __construct(string $collapsableId, string $label)
    {
        $this->collapsableId = $collapsableId;
        $this->label = $label;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.collapsable-related-entity');
    }
}
