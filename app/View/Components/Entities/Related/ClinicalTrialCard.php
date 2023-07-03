<?php

namespace App\View\Components\Entities\Related;

use App\Models\Clinicaltrial;
use Illuminate\View\Component;

class ClinicalTrialCard extends Component
{
    public Clinicaltrial $clinicalTrial;
    public ?string $classes;

    public function __construct(Clinicaltrial $clinicalTrial, ?string $classes = null)
    {
        $this->clinicalTrial = $clinicalTrial;
        $this->classes = $classes;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.clinical-trial-card');
    }
}
