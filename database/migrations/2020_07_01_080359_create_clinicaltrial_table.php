<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClinicaltrialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinicaltrials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('nct_number')->unique();
            $table->string('title');
            $table->string('acronym')->nullable();
            $table->string('status')->nullable();
            $table->string('study_results')->nullable();
            $table->string('conditions')->nullable();
            $table->string('interventions')->nullable();
            $table->longText('outcome_measures')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('phases')->nullable();
            $table->string('enrollment')->nullable();
            $table->string('funded_bys')->nullable();
            $table->string('study_type')->nullable();
            $table->longText('study_designs')->nullable();
            $table->string('other_ids')->nullable();
            $table->date('start_date')->nullable();
            $table->date('primary_completion_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->date('first_posted')->nullable();
            $table->date('results_first_posted')->nullable();
            $table->date('last_update_posted')->nullable();
            $table->string('study_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinicaltrials');
    }
}
