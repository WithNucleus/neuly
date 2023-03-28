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
        Schema::table('metrics', function (Blueprint $table) {
            $table->string('type')->default('count')->change();
            $table->string('frequency')->default('daily')->after('type');
            $table->integer('clinical_trials')->default(0)->after('investors');
            $table->integer('research')->default(0)->after('clinical_trials');
            $table->integer('locations')->default(0)->after('research');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metrics', function (Blueprint $table) {
            $table->dropColumn('frequency');
            $table->dropColumn('clinical_trials');
            $table->dropColumn('research');
            $table->dropColumn('locations');
        });
    }
};
