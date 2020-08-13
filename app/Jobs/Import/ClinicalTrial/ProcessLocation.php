<?php

namespace App\Jobs\Import\ClinicalTrial;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Clinicaltrial;
use App\Models\ImportResult;
use App\Models\Location;
use Illuminate\Support\Facades\Log;

class ProcessLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $clinicaltrial;
    private $import_result;
    private $location_details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Clinicaltrial $clinicaltrial, ImportResult $import_result, $location_details)
    {
        $this->clinicaltrial = $clinicaltrial;
        $this->import_result = $import_result;
        $this->location_details = $location_details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $debug_location_details = print_r($this->location_details, true);

        $location_id_array = array();

        $import_messages = array();

        // loop through array and find/create location
        foreach ($this->location_details as $location_array) {

            // has city?
            if (array_key_exists('city', $location_array)) {

                $location = Location::findOrCreateLocation(
                    $location_array['city'], $location_array['region'], $location_array['country']
                );

            } else {

                $location = Location::findOrCreateLocationNoCity($location_array['region'], $location_array['country']);
            }

            // If Location
            if ($location) {

                // Found Location
                $this_message = array(
                    'nct_number' => $this->clinicaltrial->nct_number,
                    'location' => $location->name,
                    'info' => 'Success',
                    // 'id' => $this->clinicaltrial->id
                );

                array_push($import_messages, $this_message);

                array_push($location_id_array, $location->id);

            } else {

                // Didn't find or create Location

                $debug_location_string = implode(', ', $location_array);

                Log::error($this->clinicaltrial->nct_number . ' ' . $this->clinicaltrial->title . "\n" . 'Did not create or find a location' . "\n" . $debug_location_string);

                $this_message = array(
                    'nct_number' => $this->clinicaltrial->nct_number,
                    'location' => $debug_location_string,
                    'info' => 'Error',
                    // 'id' => $this->clinicaltrial->id
                );

                array_push($import_messages, $this_message);
            }


        }

        // attach locations
        $this->clinicaltrial->locations()->syncWithoutDetaching($location_id_array);

        // New Messages
        $new_messages = array(
            $this->clinicaltrial->nct_number => array(
                'id' => $this->clinicaltrial->id,
                'messages' => $import_messages
            )
        );

        // Get the old messages and add to it
        $old_messages = json_decode($this->import_result->location_messages, true);

        if (!empty($old_messages)) {
            $new_messages = array_merge($old_messages, $new_messages);
        }

        $messages_json = json_encode($new_messages);

        // Update Import Result
        $importResult = ImportResult::find($this->import_result->id);
        $importResult->location_messages = $messages_json;
        $importResult->save();

    }
}
