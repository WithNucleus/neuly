<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPsychinvestdataToPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->string('twitter_followers')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('twitter_followers');
            $table->string('instagram_followers')->nullable()->after('instagram');
            $table->string('published_works')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('twitter_followers');
            $table->dropColumn('instagram');
            $table->dropColumn('instagram_followers');
            $table->dropColumn('published_works');
        });
    }
}
