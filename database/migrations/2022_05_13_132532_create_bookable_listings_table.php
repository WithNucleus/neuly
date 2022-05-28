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
            $table->string('location_name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreignId('location_id')->nullable()->references('id')->on('locations');
            $table->string('image')->nullable();
            $table->json('hours_json')->nullable();
            $table->boolean('virtual')->default(0);
            $table->foreignId('company_branch_id')->nullable()->references('id')->on('company_branches');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('bookable_listings');
    }
}
