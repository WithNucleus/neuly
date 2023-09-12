<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicaltrials', function (Blueprint $table) {
            $table->renameColumn('phases', 'phase_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicaltrials', function (Blueprint $table) {
            $table->renameColumn('phase_text', 'phases');
        });
    }
};
