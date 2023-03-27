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
        Schema::create('bookable_listing_focus', function (Blueprint $table) {
            $table->foreignId('bookable_listing_id')->references('id')->on('bookable_listings')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('focus_id')->references('id')->on('focus')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['bookable_listing_id', 'focus_id']);
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
        Schema::dropIfExists('bookable_listing_focus');
    }
};
