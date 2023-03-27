<?php

namespace App\Jobs\Import\RelatedEntities;

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
     * @var int
     */
    public $tries = 1;

    /**
     * @var mixed
     */
    private $entity;

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
    private $importSuccessMessages = [];

    /**
     * @var array
     */
    private $importFailedRecords = [];

    /**
     * ProcessLocation constructor.
     *
     * @param  string  $entityClass
     * @param  int  $entityId
     * @param  array  $locations
     *
     * @throws \Exception
     */
    public function __construct(ImportResult $importResult, $entityClass, $entityId, $locations)
    {
        $this->importResult = $importResult;
        $this->locations = $locations;
        $this->entity = $entityClass::find($entityId);

        if ($this->entity === null) {
            throw new \Exception("Entity '$entityClass' with ID $entityId not found");
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $locationIds = [];

        foreach ($this->locations as $locationName) {
            $location = Location::where('name', $locationName)->first();

            if ($location) {
                $locationIds[] = $location->id;
                $this->addSuccessMessage($location);
            } else {
                $this->addFailedRecord($locationName);
            }
        }

        $this->entity->locations()->syncWithoutDetaching($locationIds);

        $this->saveSuccessMessages();
        $this->saveFailedRecords();
    }

    /**
     * @param  \App\Models\Location  $location
     */
    private function addSuccessMessage($location)
    {
        $message = [
            'import_id' => $location->id,
            'import_value' => $location->name,
        ];

        if (! isset($this->importSuccessMessages[$this->entity->id])) {
            $this->importSuccessMessages[$this->entity->id] = [
                'target_id' => $this->entity->id,
                'messages' => [$message],
            ];
        } else {
            $this->importSuccessMessages[$this->entity->id]['messages'][] = $message;
        }
    }

    /**
     * @param  array  $locationArray
     */
    private function addFailedRecord($locationName)
    {
        $this->importFailedRecords[] = [
            'target_id' => $this->entity->id,
            'target_class' => get_class($this->entity),
            'import_value' => $locationName,
        ];
    }

    /**
     * @return void
     */
    private function saveSuccessMessages()
    {
        $oldMessages = json_decode($this->importResult->location_messages, true);

        if (! empty($oldMessages)) {
            $this->importSuccessMessages = array_merge($oldMessages, $this->importSuccessMessages);
        }

        $this->importResult->location_messages = json_encode($this->importSuccessMessages);
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
                'type' => ImportFailure::TYPE_LOCATIONS,
                'details' => json_encode($record),
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }

        ImportFailure::insert($failedRecords);
    }

    /**
     * @param  array  $record
     */
    private function logError($record)
    {
        Log::error(
            $this->entity->id.' '.$this->entity->name.':\n'.
            'Did not create or find a location.'.'\n'.json_encode($record)
        );
    }
}
