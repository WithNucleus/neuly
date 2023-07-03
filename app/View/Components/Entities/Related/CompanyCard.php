<?php

namespace App\View\Components\Entities\Related;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyCard extends Component
{
    public Company $company;
    public ?string $classes;
    public ?string $pivot;

    public function __construct(Company $company, ?string $classes = null, ?string $pivot = null)
    {
        $this->company = $company;
        $this->classes = $classes;
        $this->pivot = $pivot;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.company-card');
    }
}
