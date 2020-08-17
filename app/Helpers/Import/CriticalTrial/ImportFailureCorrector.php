<?php

namespace App\Helpers\Import\CriticalTrial;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\ImportFailure;
use App\Models\Location;
use App\Models\Person;

class ImportFailureCorrector
{

    /**
     * @param \App\Models\ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    public static function correctFailure($importFailure, $requestArray)
    {
        switch ($importFailure->type) {
            case ImportFailure::TYPE_SPONSOR_COLLABORATORS:
                $isSuccess = self::correctSponsorCollaborators($importFailure, $requestArray);
            case ImportFailure::TYPE_LOCATIONS:
                $isSuccess = self::correctLocations($importFailure, $requestArray);
        }

        if ($isSuccess === true) {
            $importFailure->delete();
            return true;
        }

        return false;
    }

    /**
     * Update or create new Company/Person entity from ImportFailure and attach to Clinicaltrial
     *
     * @param \App\Models\ImportFailure $importFailure
     * @param array $requestArray
     * @return bool
     */
    private static function correctSponsorCollaborators($importFailure, $requestArray) {
        $isSuccess      = false;
        $modelClassName = $requestArray['model'];
        $nctNumber      = $importFailure->details['nct_number'];
        $importValue    = $importFailure->details['value'];

        try {
            $clinicaltrial = Clinicaltrial::where('nct_number', $nctNumber)->firstOrFail();

            if ($modelClassName === Company::class) {
                $company = Company::updateOrCreate(['name' => $importValue]);

                $clinicaltrial->companies()->syncWithoutDetaching($company->id);
                $isSuccess = true;
            }

            if ($modelClassName === Person::class) {
                $person = Person::updateOrCreate(['name' => $importValue]);

                $clinicaltrial->people()->syncWithoutDetaching($person->id);
                $isSuccess = true;
            }
        } catch (\Throwable $e) {
            Log::error(
                "Unable to resolve ImportFailure [id = {$importFailure->id}, nct_number = {$nctNumber}].\n" .
                "ErrorMessage: " . $e->getMessage()
            );
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
        $isSuccess      = false;
        $nctNumber      = $importFailure->details['nct_number'];
        $modelClassName = $requestArray['model'];
        $country        = $requestArray['country'];
        $region         = $requestArray['region'];
        $city           = $requestArray['city'];

        try {
            $clinicaltrial = Clinicaltrial::where('nct_number', $nctNumber)->firstOrFail();

            if ($modelClassName === Location::class) {
                $location = Location::findOrCreateLocation($country, $region, $city);

                $clinicaltrial->locations()->syncWithoutDetaching($location->id);
                $isSuccess = true;
            }
        } catch (\Throwable $e) {
            Log::error(
                "Unable to resolve ImportFailure [id = {$importFailure->id}, nct_number = {$nctNumber}].\n" .
                "ErrorMessage: " . $e->getMessage()
            );
        }

        return $isSuccess;
    }
}
