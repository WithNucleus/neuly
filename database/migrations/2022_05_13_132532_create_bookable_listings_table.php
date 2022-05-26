<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookableListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookable_listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->morphs('bookable');
            $table->string('type');
            $table->string('status');
            $table->string('url')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreignId('location_id')->nullable()->references('id')->on('locations');
            $table->foreignId('company_branch_id')->nullable()->references('id')->on('company_branches');
            $table->string('image')->nullable();
            $table->json('hours_json')->nullable();
            $table->timestamps();

            // TODO: Add a location_name field instead of city/state -- that will look nicer and be easier to copy over
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookable_listings');
    }
}
