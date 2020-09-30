<?php

use App\Models\Clinicaltrial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateClinicaltrialsIntervetionsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Clinicaltrial::where('interventions', 'like', '%|%')
            ->orWhere('conditions', 'like', '%|%')
            ->update([
                'interventions' => DB::raw('REPLACE(interventions, "|", ";")'),
                'conditions' => DB::raw('REPLACE(conditions, "|", ";")'),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
