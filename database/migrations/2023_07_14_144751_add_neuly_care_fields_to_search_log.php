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
        Schema::table('search_log', function (Blueprint $table) {
            $table->string('type')->nullable()->after('term');
            $table->unsignedBigInteger('location_id')->nullable()->after('user_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->nullableMorphs('relatable');
            $table->json('data')->nullable()->after('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_log', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->dropMorphs('relatable');
            $table->dropColumn('type');
            $table->dropColumn('data');
        });
    }
};
