<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Models\Clinicaltrial;
use App\Models\ImportedEntity;
use App\Models\Person;
use Livewire\Component;

class ResponsibleParty extends Component
{
    public Clinicaltrial $clinicalTrial;

    public ?string $search = null;
    public array $results = [
        'people'
    ];

    public function updatedSearch() {
        $this->results['people'] = Person::where('name', 'like', '%' . $this->search . '%')->take(5)->get()->toArray();
    }

    public function assignPerson($entityId) {
        $this->clinicalTrial->responsible_party_id = $entityId;
        $this->clinicalTrial->responsible_party_type = Person::class;
        $this->clinicalTrial->save();
        $this->resetError();
        $this->clinicalTrial->refresh();
    }

    private function resetError() {
        $errors = $this->clinicalTrial->imported->errors;
        unset($errors[ImportedEntity::ERROR_RESPONSIBLE_PARTY]);
        $this->clinicalTrial->imported->errors = $errors;
        $this->clinicalTrial->imported->save();
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.responsible-party');
    }
}
