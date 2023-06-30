<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Company;

trait HasCompanyFilter {

    public ?string $companySearch = null;
    public array $companySearchResults = [];

    public function returnCompanySearch($entity) {
        if($this->companySearch) {
            $this->companySearchResults = Company::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->where('name', 'like', '%' . $this->companySearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->companySearchResults = Company::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setCompanyFilter($value) {
        $this->filters['companies'][] = $value;
        $this->reset('companySearch');
        $this->reset('companySearchResults');
    }

}
