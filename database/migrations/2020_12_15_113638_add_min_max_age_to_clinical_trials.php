<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinMaxAgeToClinicalTrials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicaltrials', function(Blueprint $table) {
            $table->integer('min_age')->nullable(true);
            $table->integer('max_age')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicaltrials', function(Blueprint $table) {
            $table->drop('min_age');
            $table->drop('max_age');
        });
    }
}
