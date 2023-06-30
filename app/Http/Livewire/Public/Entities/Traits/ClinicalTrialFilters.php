<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\ClinicalTrialDetails\CtCondition;

trait ClinicalTrialFilters {

    public ?string $conditionSearch = null;
    public array $conditionSearchResults = [];

    public function returnConditionSearch() {
        if($this->conditionSearch) {
            $this->conditionSearchResults = CtCondition::whereHas('clinicaltrials')
                ->withCount(['clinicaltrials'])
                ->where('value', 'like', '%' . $this->conditionSearch . '%')
                ->select(['value AS name'])
                ->withCount(['clinicaltrials AS related_count'])
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->conditionSearchResults = CtCondition::whereHas('clinicaltrials')
                ->select(['value AS name'])
                ->withCount(['clinicaltrials AS related_count'])
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setConditionFilter($value) {
        $this->filters['conditions'][] = $value;
        $this->reset('conditionSearch');
        $this->reset('conditionSearchResults');
    }

}
