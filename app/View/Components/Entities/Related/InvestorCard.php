<?php

namespace App\View\Components\Entities\Related;

use App\Models\Investor;
use Illuminate\View\Component;

class InvestorCard extends Component
{
    public Investor $investor;
    public ?string $pivot;

    public function __construct(Investor $investor, ?string $pivot = null)
    {
        $this->investor = $investor;
        $this->pivot = $pivot;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.investor-card');
    }
}
