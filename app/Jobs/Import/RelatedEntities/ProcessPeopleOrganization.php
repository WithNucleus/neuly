<?php

namespace App\Jobs\Import\RelatedEntities;

use App\Models\Company;
use App\Models\ImportFailure;
use App\Models\ImportResult;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPeopleOrganization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $tries = 1;

    /**
     * @var \App\Models\ImportResult
     */
    private $importResult;

    /**
     * @var \App\Models\Company
     */
    private $company;

    /**
     * @var array
     */
    private $personData;

    /**
     * @var array
     */
    private $importSuccessMessages = [];

    /**
     * @var array
     */
    private $importFailedRecords = [];

    /**
     * ProcessLocation constructor.
     * @param \App\Models\ImportResult $importResult
     * @param int $companyId
     * @param array $personData
     *
     * @throws \Exception
     */
    public function __construct(ImportResult $importResult, $companyId, $personData)
    {
        $this->importResult  = $importResult;
        $this->company       = Company::findOrFail($companyId);
        $this->personData    = $personData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $existingPerson = Person::where('name', $this->personData['name'])
            ->orWhere('email', $this->personData['email'])
            ->first();

        if ($existingPerson) {
            $this->addFailedRecord($existingPerson);
        } else {
            $person = Person::create([
                'name' => $this->personData['name'],
                'slug' => Person::generateUniqueSlug($this->personData['name']),
                'email' => $this->personData['email'],
                'linkedin' => $this->personData['linkedin'],
            ]);

            $person->companies()->attach([
                $this->company->id => [
                    'position' => $this->personData['position'],
                ],
            ]);

            if (!empty($this->personData['location'])) {
                ProcessLocation::dispatch($this->importResult, Person::class, $person->id, [$this->personData['location']]);
            }

            $this->addSuccessMessage($person);
        }

        $this->saveSuccessMessages();
        $this->saveFailedRecords();
    }

    /**
     * @param \App\Models\Person $person
     */
    private function addSuccessMessage($person)
    {
        $message = [
            'import_id'    => $person->id,
            'import_value' => $person->name
        ];

        if (!isset($this->importSuccessMessages[$this->company->id])) {
            $this->importSuccessMessages[$this->company->id] = [
                'target_id' => $this->company->id,
                'messages' => [$message],
            ];
        } else {
            $this->importSuccessMessages[$this->company->id]['messages'][] = $message;
        }
    }

    /**
     * @param \App\Models\Person $existingPerson
     */
    private function addFailedRecord($existingPerson)
    {
        $this->importFailedRecords[] = [
            'company_id'   => $this->company->id,
            'target_id'    => $existingPerson->id,
            'target_class' => get_class($existingPerson),
            'existing_data' => $existingPerson->toArray(),
            'import_value' => $this->personData
        ];
    }

    /**
     * @return void
     */
    private function saveSuccessMessages()
    {
        $oldMessages = json_decode($this->importResult->people_messages, true);

        if (!empty($oldMessages)) {
            $this->importSuccessMessages = array_merge($oldMessages, $this->importSuccessMessages);
        }

        $this->importResult->people_messages = json_encode($this->importSuccessMessages);
        $this->importResult->save();
    }

    /**
     * @return void
     */
    private function saveFailedRecords()
    {
        if ($this->importFailedRecords === []) {
            return;
        }

        $failedRecords = [];
        $datetime      = Carbon::now();

        foreach ($this->importFailedRecords as $record) {
            $this->logError($record);

            $failedRecords[] = [
                'import_result_id' => $this->importResult->id,
                'type'             => ImportFailure::TYPE_PEOPLE_ORGANIZATION,
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
            $this->company->id . ' ' . $this->company->name . ':\n' .
            'Can\'t import person to company, person already exist. .' . '\n' . json_encode($record)
        );
    }

}
