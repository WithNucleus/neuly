<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\ImportedEntity;
use App\Models\Person;
use Livewire\Component;

class LeadSponsor extends Component
{
    public Clinicaltrial $clinicalTrial;

    public ?string $search = null;
    public array $results = [
        'companies',
        'people'
    ];

    public function updatedSearch() {
        $this->results['companies'] = Company::where('name', 'like', '%' . $this->search . '%')->take(5)->get()->toArray();
        $this->results['people'] = Person::where('name', 'like', '%' . $this->search . '%')->take(5)->get()->toArray();
    }

    public function assignCompany($entityId) {
        $this->clinicalTrial->lead_sponsor_id = $entityId;
        $this->clinicalTrial->lead_sponsor_type = Company::class;
        $this->clinicalTrial->save();
        $this->resetError();
        $this->clinicalTrial->refresh();
    }

    public function assignPerson($entityId) {
        $this->clinicalTrial->lead_sponsor_id = $entityId;
        $this->clinicalTrial->lead_sponsor_type = Person::class;
        $this->clinicalTrial->save();
        $this->resetError();
        $this->clinicalTrial->refresh();
    }

    private function resetError() {
        $errors = $this->clinicalTrial->imported->errors;
        unset($errors[ImportedEntity::ERROR_LEAD_SPONSOR]);
        $this->clinicalTrial->imported->errors = $errors;
        $this->clinicalTrial->imported->save();
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.lead-sponsor');
    }
}
