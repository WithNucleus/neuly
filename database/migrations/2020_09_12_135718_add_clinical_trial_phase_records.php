<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ClinicaltrialPhase;

class AddClinicalTrialPhaseRecords extends Migration
{
    private $phases = array(
        [
            'name' => 'Not Applicable',
            'pretty_name' => 'Not Applicable',
            'integer' => 0
        ],
        [
            'name' => 'Early Phase 1',
            'pretty_name' => 'Early Phase 1',
            'integer' => 1
        ],
        [
            'name' => 'Phase 1',
            'pretty_name' => 'Phase 1',
            'integer' => 2
        ],
        [
            'name' => 'Phase 1|Phase 2',
            'pretty_name' => 'Phase 2',
            'integer' => 3
        ],
        [
            'name' => 'Phase 2',
            'pretty_name' => 'Phase 2',
            'integer' => 3
        ],
        [
            'name' => 'Phase 2|Phase 3',
            'pretty_name' => 'Phase 3',
            'integer' => 4
        ],
        [
            'name' => 'Phase 3',
            'pretty_name' => 'Phase 3',
            'integer' => 4
        ],
        [
            'name' => 'Phase 4',
            'pretty_name' => 'Phase 4',
            'integer' => 5
        ],
    );

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach ($this->phases as $phase) {
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
        foreach ($this->phases as $phase) {
            ClinicaltrialPhase::find($phase['name'])->delete();
        }
    }
}
