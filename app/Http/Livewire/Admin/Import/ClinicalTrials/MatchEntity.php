<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Jobs\Import\ClinicalTrial\ImportProcess;
use App\Models\Clinicaltrial;
use App\Models\ImportedEntity;
use Livewire\Component;

class MatchEntity extends Component
{
    public ImportedEntity $importedEntity;
    public $clinicalTrial;
    public bool $showPage = false;

    public function mount() {
        if ($this->importedEntity->importable) {
            $this->clinicalTrial = $this->importedEntity->importable;

        } else {
            $match = Clinicaltrial::where('nct_number', $this->importedEntity->name)->first();

            if ($match) {
                $this->clinicalTrial = $match;
                $this->importedEntity->importable_id = $match->id;
                $this->importedEntity->save();
            }
        }
    }

    public function createEntity() {
        ImportProcess::dispatch($this->importedEntity);
        $this->dispatchBrowserEvent('toast-notification',  ['text' => $this->importedEntity->name . ' sent for processing!', 'background' => 'bg-success']);
    }

    public function updateEntity() {
        ImportProcess::dispatch($this->importedEntity);
        $this->dispatchBrowserEvent('toast-notification',  ['text' => $this->importedEntity->name . ' sent for processing!', 'background' => 'bg-success']);
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.match-entity');
    }
}
