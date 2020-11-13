<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEntitiesChangeImageValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('companies')->update(['logo' => DB::raw("REPLACE(logo, 'logos/', '')")]);
        DB::table('investors')->update(['logo' => DB::raw("REPLACE(logo, 'logos/', '')")]);
        DB::table('people')->update(['photo' => DB::raw("REPLACE(photo, 'people/', '')")]);
        DB::table('events')->update(['image' => DB::raw("REPLACE(image, 'events/', '')")]);
        DB::table('news_articles')->update(['image' => DB::raw("REPLACE(image, 'news/', '')")]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //no need to revert data changes
    }
}
