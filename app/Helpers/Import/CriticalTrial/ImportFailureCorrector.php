<?php

namespace App\Helpers\Import\CriticalTrial;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\ImportFailure;
use App\Models\Person;

class ImportFailureCorrector
{

    /**
     * @param \App\Models\ImportFailure $importFailure
     * @param string $modelClassName
     * @return bool
     */
    public static function correctFailure($importFailure, $modelClassName)
    {
        switch ($importFailure->type) {
            case ImportFailure::TYPE_SPONSOR_COLLABORATORS:
                return self::correctSponsorCollaborators($importFailure, $modelClassName);
        }

        return false;
    }

    /**
     * Update or create new Company/Person entity from ImportFailure and attach to Clinicaltrial
     *
     * @param \App\Models\ImportFailure $importFailure
     * @param string $modelClassName
     * @return bool
     */
    private static function correctSponsorCollaborators($importFailure, $modelClassName) {
        $success     = false;
        $nctNumber   = $importFailure->details['nct_number'];
        $importValue = $importFailure->details['value'];

        try {
            $clinicaltrial = Clinicaltrial::where('nct_number', $nctNumber)->firstOrFail();

            if ($modelClassName === Company::class) {
                $company = Company::updateOrCreate(['name' => $importValue]);
                // attach companies
                $clinicaltrial->companies()->syncWithoutDetaching($company->id);
                $success = true;
            }

            if ($modelClassName === Person::class) {
                $person = Person::updateOrCreate(['name' => $importValue]);
                // attach people
                $clinicaltrial->people()->syncWithoutDetaching($person->id);
                $success = true;
            }
        } catch (\Exception $e) {
            Log::error(
                "Unable to resolve ImportFailure [id = {$importFailure->id}, nct_number = {$nctNumber}].\n" .
                "ErrorMessage: " . $e->getMessage()
            );
        }

        // delete current failure record
        if ($success) {
            $importFailure->delete();
        }

        return $success;
    }
}
