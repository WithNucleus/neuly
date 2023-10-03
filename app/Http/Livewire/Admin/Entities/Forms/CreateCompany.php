<?php

namespace App\Http\Livewire\Admin\Entities\Forms;

use App\Models\Company;
use Livewire\Component;

class CreateCompany extends Component
{
    public bool $success = false;

    public $name;
    public $ownership;
    public $website;
    public $ticker_symbol;
    public $summary;
    public $linkedin;
    public $facebook;
    public $instagram;

    public function rules() {
        return [
            'name' => 'required|unique:companies',
            'ownership' => 'required',
            'website' => 'nullable',
            'summary' => 'nullable',
            'ticker_symbol' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable'
        ];
    }

    public function submit()
    {
        $this->validate();
        Company::create($this->validate());
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.admin.entities.forms.create-company', [
            'ownershipOptions' => Company::OWNERSHIP
        ]);
    }
}
