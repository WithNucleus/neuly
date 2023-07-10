<?php

namespace App\View\Components\Badge;

use Illuminate\View\Component;

class TertiaryBadge extends Component
{
    public ?string $marginClasses;

    public function __construct(?string $marginClasses = null)
    {
        $this->marginClasses = $marginClasses;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.badge.tertiary-badge');
    }
}
