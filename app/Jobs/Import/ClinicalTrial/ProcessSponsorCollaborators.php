<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\ImportFailure;
use App\Models\ImportResult;
use App\Models\ImportSetting;
use App\Models\Person;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSponsorCollaborators
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Clinicaltrial
     */
    private $clinicaltrial;

    /**
     * @var \App\Models\ImportResult
     */
    private $importResult;

    /**
     * @var array
     */
    private $values;

    /**
     * @var array
     */
    private $importCompanyMessages = [];

    /**
     * @var array
     */
    private $importPersonMessages = [];

    /**
     * @var array
     */
    private $importFailedRecords = [];

    /**
     * @var array
     */
    private $companyMappingSettings = [];

    /**
     * Company names mapped as id => name
     * @var array
     */
    private $existedCompanyNames = [];

    /**
     * Person names mapped as id => name
     * @var array
     */
    private $existedPersonNames = [];

    /**
     * ProcessSponsorCollaborators constructor.
     * @param \App\Models\Clinicaltrial $clinicaltrial
     * @param \App\Models\ImportResult $importResult
     * @param array $values
     *
     * @return void
     */
    public function __construct(Clinicaltrial $clinicaltrial, ImportResult $importResult, array $values)
    {
        $this->clinicaltrial = $clinicaltrial;
        $this->importResult  = $importResult;
        $this->values        = $values;

        $importSettings = ImportSetting::where('id', 1)->first();

        if (!empty($importSettings) && !empty($importSettings->mapping_organisation)) {
            $this->companyMappingSettings = $importSettings->mapping_organisation;
        }

        $this->existedCompanyNames = Company::all()->pluck('name', 'id');
        $this->existedPersonNames  = Person::all()->pluck('name', 'id');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $companyIds     = [];
        $personIds      = [];
        $failed         = [];

        // loop through array and find/create entity
        foreach ($this->values as $value) {

            // is value has word in companyMappingSettings keywords
            if ($this->checkValueInMappingOrganisationSettings($value)) {
                $company      = Company::firstOrCreate(['name' => $value]);
                $companyIds[] = $company->id;
                $this->addCompanyMessage($company->id, $value);
                continue;
            }

            // is value == name of already existed company
            if ($companyId = $this->checkValueInExistingCompanies($value)) {
                $companyIds[] = $companyId;
                $this->addCompanyMessage($companyId, $value);
                continue;
            }

            // is value == name of already existed person
            if ($personId = $this->checkValueInExistingPersons($value)) {
                $personIds[] = $personId;
                $this->addPersonMessage($personId, $value);
                continue;
            }

            // can't map value to Company or Person
            $failed[] = $value;
            $this->addFailedRecord($value);
        }

        // attach companies
        $this->clinicaltrial->companies()->syncWithoutDetaching($companyIds);
        // attach people
        $this->clinicaltrial->people()->syncWithoutDetaching($personIds);

        $this->saveImportMessages();
        $this->saveFailedRecords();
    }

    /**
     * @param string $value
     * @return bool
     */
    private function checkValueInMappingOrganisationSettings($value) {
        foreach ($this->companyMappingSettings as $mappingKeyword) {
            if (stripos($value, $mappingKeyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $value
     * @return int|bool
     */
    private function checkValueInExistingCompanies($value) {
        foreach ($this->existedCompanyNames as $id => $name) {
            if ($value == $name) {
                return $id;
            }
        }

        return false;
    }

    /**
     * @param string $value
     * @return int|bool
     */
    private function checkValueInExistingPersons($value) {
        foreach ($this->existedPersonNames as $id => $name) {
            if ($value == $name) {
                return $id;
            }
        }

        return false;
    }

    /**
     * @param int $companyId
     * @param string $value
     */
    private function addCompanyMessage($companyId, $value)
    {
        $meesage = [
            'nct_number' => $this->clinicaltrial->nct_number,
            'id'         => $companyId,
            'company'    => $value,
            'info'       => 'Success',
        ];

        if (!isset($this->importCompanyMessages[$this->clinicaltrial->nct_number])) {
            //first addition by number
            $this->importCompanyMessages[$this->clinicaltrial->nct_number] = [
                'id' => $this->clinicaltrial->id,
                'messages' => [$meesage],
            ];
        } else {
            $this->importCompanyMessages[$this->clinicaltrial->nct_number]['messages'][] = $meesage;
        }

    }

    /**
     * @param int $personId
     * @param string $value
     */
    private function addPersonMessage($personId, $value)
    {
        $meesage = [
            'nct_number' => $this->clinicaltrial->nct_number,
            'id'         => $personId,
            'person'     => $value,
            'info'       => 'Success',
        ];

        if (!isset($this->importPersonMessages[$this->clinicaltrial->nct_number])) {
            //first addition by number
            $this->importPersonMessages[$this->clinicaltrial->nct_number] = [
                'id' => $this->clinicaltrial->id,
                'messages' => [$meesage],
            ];
        } else {
            $this->importPersonMessages[$this->clinicaltrial->nct_number]['messages'][] = $meesage;
        }
    }

    /**
     * @param string $value
     */
    private function addFailedRecord($value)
    {
        $this->importFailedRecords[] = [
            'nct_number' => $this->clinicaltrial->nct_number,
            'value'       => $value,
            'info'       => 'Failed',
        ];
    }

    /**
     * @return void
     */
    private function saveImportMessages()
    {
        // Get the old messages and add to it
        $oldCompanyMessages = json_decode($this->importResult->company_messages, true);
        $oldPeopleMessages  = json_decode($this->importResult->people_messages, true);

        if (!empty($oldCompanyMessages)) {
            $this->importCompanyMessages = array_merge($this->importCompanyMessages, $oldCompanyMessages);
        }

        if (!empty($oldPeopleMessages)) {
            $this->importPersonMessages = array_merge($this->importPersonMessages, $oldPeopleMessages);
        }

        // Update Import Result
        $this->importResult->company_messages = json_encode($this->importCompanyMessages);
        $this->importResult->people_messages = json_encode($this->importPersonMessages);;
        $this->importResult->save();
    }

    /**
     * @return void
     */
    private function saveFailedRecords()
    {
        if (empty($this->importFailedRecords)) {
            return;
        }

        $failedRecords = [];
        $datetime      = Carbon::now();

        foreach ($this->importFailedRecords as $record) {
            $this->logError($record);

            $failedRecords[] = [
                'import_result_id' => $this->importResult->id,
                'type'             => ImportFailure::TYPE_SPONSOR_COLLABORATORS,
                'details'          => json_encode($record),
                'created_at'       => $datetime,
                'updated_at'       => $datetime,
            ];
        }

        ImportFailure::insert($failedRecords);
    }

    /**
     * @param array $record
     */
    private function logError($record)
    {
        Log::error(
            $this->clinicaltrial->nct_number . ' ' . $this->clinicaltrial->title . "\n" .
            'Did not create or find a organisation/person.' . "\n" . json_encode($record)
        );
    }

}
