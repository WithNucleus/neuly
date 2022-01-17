<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFocusMediaItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('focus_media_item', function (Blueprint $table) {
            $table->foreignId('focus_id')->constrained('focus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('media_item_id')->constrained('media_items')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('focus_media_item');
    }
}
