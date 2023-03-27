<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $companyOwnershipValuesToFix = [
            'Public Company',
            'Privately Held',
            'Educational Institution',
            'Government Agency',
            'Non-Profit',
        ];

        foreach ($companyOwnershipValuesToFix as $wrongValue => $correctValue) {
            DB::table('companies')
                ->where('ownership', (string) $wrongValue)
                ->update(['ownership' => $correctValue]);
        }

        $jobEmploymentTypeValuesToFix = [
            'Full Time',
            'Part Time',
            'One Time',
        ];

        foreach ($jobEmploymentTypeValuesToFix as $wrongValue => $correctValue) {
            DB::table('jobs')
                ->where('employment_type', (string) $wrongValue)
                ->update(['employment_type' => $correctValue]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //not needed
    }
};
