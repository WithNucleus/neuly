<?php

namespace App\Helpers\Import\RelatedEntities;

use App\Jobs\Import\RelatedEntities\ProcessLocation;
use App\Models\ImportFailure;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportFailureCorrector
{

    /**
     * @param \App\Models\ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    public static function correctFailure(ImportFailure $importFailure, array $requestArray)
    {
        $isSuccess = false;

        switch ($importFailure->type) {
            case ImportFailure::TYPE_LOCATIONS:
                $isSuccess = self::correctLocations($importFailure, $requestArray);
                break;
            case ImportFailure::TYPE_PEOPLE_ORGANIZATION:
                $isSuccess = self::correctPeopleOrganisation($importFailure, $requestArray);
                break;
        }

        if ($isSuccess === true) {
            $importFailure->delete();
        }

        return $isSuccess;
    }

    /**
     * Update or create new Location entity from ImportFailure and attach to Clinicaltrial
     *
     * @param \App\Models\ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    private static function correctLocations($importFailure, $requestArray)
    {
        $isSuccess   = false;
        $targetId    = $importFailure->details['target_id'];
        $targetClass = $importFailure->details['target_class'];
        $modelClass  = $requestArray['model'];
        $country     = null;
        $region      = null;
        $city        = null;
        $locationId  = null;

        if (isset($requestArray['location_id'])) {
            $locationId = $requestArray['location_id'];
        } else {
            $country = $requestArray['country'];
            $region  = $requestArray['region'];
            $city    = $requestArray['city'];
        }

        try {
            $targetEntity = $targetClass::findOrFail($targetId);

            if ($modelClass === Location::class) {
                if ($locationId) {
                    $location = Location::findOrFail($locationId);
                } else {
                    $location = Location::findOrCreateLocation($country, $region, $city);
                }

                $targetEntity->locations()->syncWithoutDetaching($location->id);
                $isSuccess = true;
            }
        } catch (\Throwable $exception) {
            self::logError($importFailure, $exception);
        }

        return $isSuccess;
    }

    /**
     * @param \App\Models\ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    private static function correctPeopleOrganisation($importFailure, $requestArray)
    {
        $isSuccess = false;
        $targetId  = $importFailure->details['target_id'];
        $type      = $requestArray['type'];

        try {
            if ($type === 'create') {
                Validator::make($requestArray, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:people',
                ])->validate();

                $person = new Person();
                $person->name = $requestArray['name'];
                $person->slug = Person::generateUniqueSlug($requestArray['name']);
                $person->email = $requestArray['email'];
                $person->linkedin = isset($requestArray['linkedin']) ? $requestArray['linkedin'] : null;

                $person->save();

            } elseif ($type === 'update') {
                $person = Person::findOrFail($targetId);

                if (isset($requestArray['name'])) {
                    $person->name = $requestArray['name'];
                }

                if (isset($requestArray['email'])) {
                    $person->email = $requestArray['email'];
                }

                if (isset($requestArray['linkedin'])) {
                    $person->linkedin = $requestArray['linkedin'];
                }

                $person->update();
            }

            if (isset($requestArray['location'])) {
                ProcessLocation::dispatch($importFailure->result, Person::class, $person->id, [$requestArray['location']]);
            }

            if (isset($requestArray['position']) && isset($requestArray['company_id'])) {
                $person->companies()->syncWithoutDetaching([
                    $requestArray['company_id'] => [
                        'position' => $requestArray['position']
                    ]
                ]);
            }

            $isSuccess = true;

        } catch (\Throwable $exception) {
            self::logError($importFailure, $e);
        }

        return $isSuccess;
    }

    /**
     * @param \App\Models\ImportFailure $importFailure
     * @param \Throwable $exception
     */
    private static function logError($importFailure, $exception)
    {
        Log::error(
            "Unable to resolve ImportFailure [id = {$importFailure->id}, type = {$importFailure->type}].\n" .
            "ErrorMessage: " . $exception->getMessage()
        );
    }
}
