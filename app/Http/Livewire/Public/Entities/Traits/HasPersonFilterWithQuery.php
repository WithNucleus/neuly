<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Person;

trait HasPersonFilterWithQuery {
    public ?string $personSearch = null;
    public array $personSearchResults = [];

    public function returnPersonSearch($entity, $queryField, $queryComparison, $queryValue) {
        if($this->personSearch) {
            $this->personSearchResults = Person::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} AS related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
                ->orderByDesc('related_count')
                ->where('name', 'like', '%' . $this->personSearch . '%')
                ->get()
                ->toArray();
        } else {
            $this->personSearchResults = Person::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} AS related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setPersonFilter($value) {
        $this->filters['people'][] = $value;
        $this->reset('personSearch');
        $this->reset('personSearchResults');
    }
}
