<?php

namespace App\View\Components\Entities\Related;

use App\Models\Company;
use Illuminate\View\Component;

class CompanySubsidiaryCard extends Component
{
    public Company $subsidiary;

    public function __construct(Company $subsidiary)
    {
        $this->subsidiary = $subsidiary;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.company-subsidiary-card');
    }
}
