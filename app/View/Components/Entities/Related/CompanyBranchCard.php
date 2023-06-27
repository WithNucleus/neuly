<?php

namespace App\View\Components\Entities\Related;

use App\Models\CompanyBranch;
use Illuminate\View\Component;

class CompanyBranchCard extends Component
{
    public CompanyBranch $companyBranch;

    public function __construct(CompanyBranch $companyBranch)
    {
        $this->companyBranch = $companyBranch;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.company-branch-card');
    }
}
