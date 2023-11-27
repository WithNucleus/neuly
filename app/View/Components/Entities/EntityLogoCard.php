<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityLogoCard extends Component
{
    public string $url;
    public string $linkClasses;
    public ?string $cardClasses;
    public ?string $cardBodyClasses;

    public function __construct(string $url, string $linkClasses = 'py-4', string $cardClasses = null, string $cardBodyClasses = null)
    {
        $this->url = $url;
        $this->linkClasses = $linkClasses;
        $this->cardClasses = $cardClasses;
        $this->cardBodyClasses = $cardBodyClasses;
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
