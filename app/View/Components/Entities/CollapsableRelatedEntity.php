<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class CollapsableRelatedEntity extends Component
{
    public string $collapsableId;
    public string $label;
    public string $bgColor;
    public string $headingColor;

    public function __construct(string $collapsableId, string $label, $bgColor = 'bg-success', $headingColor = 'text-white')
    {
        $this->collapsableId = $collapsableId;
        $this->label = $label;
        $this->bgColor = $bgColor;
        $this->headingColor = $headingColor;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.collapsable-related-entity');
    }
}
