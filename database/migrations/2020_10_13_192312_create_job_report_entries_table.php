<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReportEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_report_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('position');
            $table->tinyInteger('currently_hiring');
            $table->string('job_listing_src')->nullable();
            $table->string('job_listing_url')->nullable();
            $table->string('most_important_role')->nullable();
            $table->string('holding_from_expanding')->nullable();
            $table->string('job_growth_forecast')->nullable();
            $table->text('psychedelics_will_decrease')->nullable();
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
        Schema::dropIfExists('job_report_entries');
    }
}
