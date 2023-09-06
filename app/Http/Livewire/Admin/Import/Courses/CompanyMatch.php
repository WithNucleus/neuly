<?php

namespace App\Http\Livewire\Admin\Import\Courses;

use App\Models\Company;
use App\Models\ImportResult;
use Livewire\Component;
use Throwable;

class CompanyMatch extends Component
{
    public ImportResult $importResult;

    public string $status = 'Pending';
    public ?string $error = null;

    public string $companyName;
    public ?string $companyUrl;
    public array $courseIds;

    public ?string $companySearch;
    public ?array $companyResults = [];

    public ?string $company_name = null;
    public ?string $company_url = null;

    public function mount() {
        $this->companySearch = $this->companyName;
        $this->searchCompanies();
        $this->company_name = $this->companyName;
        $this->company_url = $this->companyUrl;
    }

    public function rules() {
        return [
            'company_name' => 'required',
            'company_url' => 'nullable'
        ];
    }

    public function updatedCompanySearch() {
        $this->searchCompanies();
    }

    public function searchCompanies() {
        $this->companyResults = Company::where('name', 'like', '%' . $this->companySearch . '%')->take(5)->get()->toArray();
    }

    public function matchExistingCompany($companyId) {
        try {
            $company = Company::findOrFail($companyId);
            $company->courses()->sync($this->courseIds);

            $this->status = 'Completed company match!';
            $this->reset('error');
            $this->removeThisCompanyMessage();
        } catch(Throwable $exception) {
            // TODO: Notify Sydney
            $this->error = $exception->getMessage();
        }
    }

    public function createNewCompany() {
        try {
            $company = Company::create([
               'name' => $this->company_name,
               'url' => $this->company_url
            ]);
            $company->courses()->sync($this->courseIds);

            $this->status = 'Created ' . $company->name . ' and added courses!';
            $this->reset('error');
            $this->removeThisCompanyMessage();
        } catch(Throwable $exception) {
            // TODO: Notify Sydney
            $this->error = $exception->getMessage();
        }
    }

    public function removeThisCompanyMessage() {
        $companyMessages = $this->importResult->company_messages;
        unset($companyMessages[$this->companyName]);
        $this->importResult->company_messages = $companyMessages;
        $this->importResult->save();
        $this->importResult->refresh();
    }

    public function render()
    {
        return view('livewire.admin.import.courses.company-match');
    }
}
