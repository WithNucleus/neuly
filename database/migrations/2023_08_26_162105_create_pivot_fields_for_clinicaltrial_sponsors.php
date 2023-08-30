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
        Schema::table('clinicaltrial_company', function (Blueprint $table) {
            $table->string('type')->nullable()->after('company_id');
            $table->string('class')->nullable()->after('type');
        });

        Schema::table('clinicaltrial_person', function (Blueprint $table) {
            $table->string('type')->nullable()->after('person_id');
            $table->string('class')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicaltrial_company', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('class');
        });

        Schema::table('clinicaltrial_person', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('class');
        });
    }
};
