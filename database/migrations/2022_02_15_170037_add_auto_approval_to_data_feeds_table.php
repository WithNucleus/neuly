<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoApprovalToDataFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_feeds', function (Blueprint $table) {
            $table->boolean('auto_approval')->after('summary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_feeds', function (Blueprint $table) {
            $table->dropColumn('auto_approval');
        });
    }
}
