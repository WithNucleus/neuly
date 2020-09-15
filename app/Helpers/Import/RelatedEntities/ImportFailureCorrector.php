<?php

namespace App\Helpers\Import\RelatedEntities;

use App\Models\ImportFailure;
use App\Models\Location;

class ImportFailureCorrector
{

    /**
     * @param ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    public static function correctFailure($importFailure, $requestArray)
    {
        $isSuccess = false;

        switch ($importFailure->type) {
            case ImportFailure::TYPE_LOCATIONS:
                $isSuccess = self::correctLocations($importFailure, $requestArray);
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
        } catch (\Throwable $e) {
            Log::error(
                "Unable to resolve ImportFailure [id = {$importFailure->id}].\n" .
                "ErrorMessage: " . $e->getMessage()
            );
        }

        return $isSuccess;
    }
}
