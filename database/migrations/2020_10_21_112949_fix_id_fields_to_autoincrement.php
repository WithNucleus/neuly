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
        Schema::table('autoincrement', function (Blueprint $table) {
            Schema::table('firewall_ips', function (Blueprint $table) {
                $table->bigIncrements('id')->change();
            });

            Schema::table('firewall_logs', function (Blueprint $table) {
                $table->bigIncrements('id')->change();
            });

            Schema::table('pages', function (Blueprint $table) {
                $table->bigIncrements('id')->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //nothing to rollback
    }
};
