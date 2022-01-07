<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('media_type')->nullable();
            $table->string('url', 500)->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->nullableMorphs('source');
            $table->date('date');
            $table->string('icon_url')->nullable();
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
        Schema::dropIfExists('media_items');
    }
}
