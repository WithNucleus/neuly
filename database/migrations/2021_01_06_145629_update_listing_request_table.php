<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateListingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_requests', function (Blueprint $table) {
            $table->renameColumn('type', 'entity_type');
            $table->dropColumn('is_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_requests', function (Blueprint $table) {
            $table->renameColumn('entity_type', 'type');
            $table->boolean('is_update')->after('comment');
        });
    }
}
