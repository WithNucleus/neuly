<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityLogoCard extends Component
{
    public string $url;
    public string $linkClasses;

    public function __construct(string $url, string $linkClasses = 'py-4')
    {
        $this->url = $url;
        $this->linkClasses = $linkClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.entities.entity-logo-card');
    }
}
