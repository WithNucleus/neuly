<?php

namespace App\View\Components\Entities\ClinicalTrials;

use Illuminate\View\Component;

class OutcomeMeasure extends Component
{
    public string $uniqueId;
    public array $item;

    public function __construct(string $uniqueId, array $item)
    {
        $this->uniqueId = $uniqueId;
        $this->item = $item;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.clinical-trials.outcome-measure');
    }
}
