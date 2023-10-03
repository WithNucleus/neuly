<?php

namespace App\Http\Livewire\Admin\Entities\Forms;

use App\Models\Company;
use App\Models\Person;
use Livewire\Component;

class CreatePerson extends Component
{
    public bool $success = false;

    public $name;
    public $email;
    public $website;
    public $byline;
    public $bio;
    public $linkedin;
    public $facebook;
    public $instagram;
    public $google_scholar;

    public $company_search;
    public array $companySearchResults = [];
    public $company;
    public $companyId;
    public $company_role;

    public function rules() {
        return [
            'name' => 'required|unique:people',
            'email' => 'nullable|email',
            'website' => 'nullable',
            'byline' => 'nullable',
            'bio' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'google_scholar' => 'nullable',
            'company' => 'required',
            'company_role' => 'required'
        ];
    }

    public function submit() {
        $this->validate();
        $person = Person::create($this->validate());
        $person->companies()->attach($this->companyId, ['position' => $this->company_role]);
        $this->success = true;
    }

    public function updatedCompanySearch() {
        if($this->company_search) {
            $this->companySearchResults = Company::where('name', 'like', '%' . $this->company_search . '%')
                ->take(5)
                ->get()
                ->toArray();
        } else {
            $this->companySearchResults = [];
        }
    }

    public function assignCompany($id) {
        $company = Company::findOrFail($id);
        $this->company = $company->name;
        $this->companyId = $id;
        $this->reset('company_search');
    }

    public function render()
    {
        return view('livewire.admin.entities.forms.create-person');
    }
}
