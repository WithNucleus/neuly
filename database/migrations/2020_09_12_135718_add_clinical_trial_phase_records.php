<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ClinicaltrialPhase;

class AddClinicalTrialPhaseRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $phases = ClinicaltrialPhase::getPhases();

        foreach ($phases as $phase) {
            ClinicaltrialPhase::create([
                'name' => $phase['name'],
                'pretty_name' => $phase['pretty_name'],
                'integer' => $phase['integer']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $phases = ClinicaltrialPhase::getPhases();

        foreach ($phases as $phase) {
            ClinicaltrialPhase::find($phase['name'])->delete();
        }
    }
}
