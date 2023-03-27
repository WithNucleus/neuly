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
        // Companies Table
        Schema::table('companies', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Focus Table
        Schema::table('focus', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Investors Table
        Schema::table('investors', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Locations Table
        Schema::table('locations', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // People Table
        Schema::table('people', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Research Table
        Schema::table('research', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Companies Table
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Focus Table
        Schema::table('focus', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Investors Table
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Locations Table
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // People Table
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Research Table
        Schema::table('research', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
