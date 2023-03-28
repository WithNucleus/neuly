<?php

use App\Models\ClinicaltrialPhase;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
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
                'integer' => $phase['integer'],
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
};
