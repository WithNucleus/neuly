<?php

use App\Models\ImportFailure;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImportFailuresChangeTypeValues extends Migration
{
    /**
     * Run the migrations.
     * Update existed records with the old constant's value to the new one
     *
     * @return void
     */
    public function up()
    {
        ImportFailure::where('type', 'Sponsor/Collaborators')
            ->update(['type' => ImportFailure::TYPE_SPONSOR_COLLABORATORS]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //no need to revert column's data
    }
}
