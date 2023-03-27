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
        Schema::create('navigation_tile_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navigation_tile_id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('type')->default('link');
            $table->string('badge')->nullable();
            $table->integer('order');
            $table->foreign('navigation_tile_id')->references('id')->on('navigation_tiles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('navigation_tile_items');
    }
};
