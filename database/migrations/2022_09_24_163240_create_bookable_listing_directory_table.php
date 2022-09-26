<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookableListingDirectoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookable_listing_directory', function (Blueprint $table) {
            $table->foreignId('bookable_listing_id')->references('id')->on('bookable_listings');
            $table->foreignId('directory_id')->references('id')->on('directories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookable_listing_directory');
    }
}
