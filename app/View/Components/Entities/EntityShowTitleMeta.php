<?php

namespace App\View\Components\Entities;

use Illuminate\View\Component;

class EntityShowTitleMeta extends Component
{
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.entity-show-title-meta');
    }
}
