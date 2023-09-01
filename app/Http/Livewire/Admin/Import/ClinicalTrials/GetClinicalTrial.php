<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Models\Clinicaltrial;
use Livewire\Component;

class GetClinicalTrial extends Component
{
    public $nctNumber;

    public function rules() {
        return [
            'nctNumber' => 'required'
        ];
    }

    public function submit() {
        $this->validate();
        dd($this->validate());
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.get-clinical-trial');
    }
}
