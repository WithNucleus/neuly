<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClinicaltrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicaltrials', function (Blueprint $table) {
            $table->text('brief_summary')->nullable()->after('study_url');
            $table->text('detailed_description')->nullable()->after('brief_summary');
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
            $table->dropColumn(['brief_summary', 'detailed_description']);
        });
    }
}
