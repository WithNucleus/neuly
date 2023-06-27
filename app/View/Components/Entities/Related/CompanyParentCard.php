<?php

namespace App\View\Components\Entities\Related;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyParentCard extends Component
{
    public Company $parent;

    public function __construct(Company $parent)
    {
        $this->parent = $parent;
    }

    public function render()
    {
        return view('components.entities.related.company-parent-card');
    }
}
