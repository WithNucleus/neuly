<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateTypeColumnListingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE listing_requests MODIFY type enum('event', 'investor', 'organization', 'person', 'other', 'job') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DELETE FROM listing_requests WHERE type = 'job'");
        DB::statement("ALTER TABLE listing_requests MODIFY type enum('event', 'investor', 'organization', 'person', 'other') NOT NULL");
    }
}
