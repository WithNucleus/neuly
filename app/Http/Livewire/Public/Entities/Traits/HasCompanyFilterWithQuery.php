<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Company;

trait HasCompanyFilterWithQuery {

    public ?string $companySearch = null;
    public array $companySearchResults = [];

    public function returnCompanySearch($entity, $queryField, $queryComparison, $queryValue) {
        if($this->companySearch) {
            $this->companySearchResults = Company::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} AS related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
                ->where('name', 'like', '%' . $this->companySearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->companySearchResults = Company::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} AS related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
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
