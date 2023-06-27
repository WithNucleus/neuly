<?php

namespace App\View\Components\Entities\Related;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyCard extends Component
{
    public Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.company-card');
    }
}
