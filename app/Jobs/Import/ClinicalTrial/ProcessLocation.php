<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Helpers\StringHelper;
use App\Models\Clinicaltrial;
use App\Models\ImportFailure;
use App\Models\ImportResult;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessLocation implements ShouldQueue
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
    private $locations;

    /**
     * @var array
     */
    private $importMessages = [];

    /**
     * @var array
     */
    private $importFailedRecords = [];

    /**
     * ProcessLocation constructor.
     * @param \App\Models\Clinicaltrial $clinicaltrial
     * @param \App\Models\ImportResult $importResult
     * @param array $locations
     */
    public function __construct(Clinicaltrial $clinicaltrial, ImportResult $importResult, $locations)
    {
        $this->clinicaltrial = $clinicaltrial;
        $this->importResult = $importResult;
        $this->locations = $this->mapLocationParts($locations);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $locationIds = [];

        foreach ($this->locations as $locationData) {
            $query = Location::where('country', $locationData['country']);

            if ($locationData['region']) {
                $query->where('region', $locationData['region']);
            }

            if ($locationData['city']) {
                $query->where('city', $locationData['city']);
            }

            $location = $query->first();

            if ($location) {
                $locationIds[] = $location->id;
                $this->addImportMessage($location);
            } else {
                $this->addFailedRecord($locationData);
            }
        }

        $this->clinicaltrial->locations()->syncWithoutDetaching($locationIds);

        $this->saveImportMessages();
        $this->saveFailedRecords();
    }

    /**
     * @param array $locations
     * @return array
     */
    private function mapLocationParts($locations)
    {
        $mappedLocations = [];

        foreach ($locations as $location) {
            $locationParts = StringHelper::explodeAndFilterEmpty($location, ',');
            $locationParts = array_reverse($locationParts);

            if ($locationParts !== []) {
                $newLocation['country'] = ($locationParts[0] == 'United States') ? 'USA' : $locationParts[0];
                // Not sure on the format so take what is hopefully the country and region
                $newLocation['region'] = isset($locationParts[1]) ? $locationParts[1] : '';
                $newLocation['city'] = isset($locationParts[2]) ? $locationParts[2] : '';

                $mappedLocations[] = $newLocation;
            }
        }

        return $mappedLocations;
    }

    /**
     * @param \App\Models\Location $location
     */
    private function addImportMessage($location)
    {
        $nctNumber = $this->clinicaltrial->nct_number;
        $message = [
            'import_id'    => $location->id,
            'import_value' => $location->name,
        ];

        if (! isset($this->importMessages[$nctNumber])) {
            $this->importMessages[$nctNumber] = [
                'clinicaltrial_id' => $this->clinicaltrial->id,
                'messages' => [$message],
            ];
        } else {
            $this->importMessages[$nctNumber]['messages'][] = $message;
        }
    }

    /**
     * @param array $locationArray
     */
    private function addFailedRecord($locationData)
    {
        $this->importFailedRecords[] = [
            'nct_number' => $this->clinicaltrial->nct_number,
            'target_id'    => $this->clinicaltrial->id,
            'target_class' => get_class($this->clinicaltrial),
            'import_value' => implode(', ', $locationData),
        ];
    }

    /**
     * @return void
     */
    private function saveImportMessages()
    {
        $oldMessages = json_decode($this->importResult->location_messages, true);

        if (! empty($oldMessages)) {
            $this->importMessages = array_merge($this->importMessages, $oldMessages);
        }

        $this->importResult->location_messages = json_encode($this->importMessages);
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
        $datetime = Carbon::now();

        foreach ($this->importFailedRecords as $record) {
            $this->logError($record);

            $failedRecords[] = [
                'import_result_id' => $this->importResult->id,
                'type'             => ImportFailure::TYPE_LOCATIONS,
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
            $this->clinicaltrial->nct_number.' '.$this->clinicaltrial->title.':\n'.
            'Did not create or find a location.'.'\n'.json_encode($record)
        );
    }
}
