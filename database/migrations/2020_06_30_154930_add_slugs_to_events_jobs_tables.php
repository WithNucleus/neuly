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
        // Events Table
        Schema::table('events', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Jobs Table
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('job_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Events Table
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Jobs Table
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
