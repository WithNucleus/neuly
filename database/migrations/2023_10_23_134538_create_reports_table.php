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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('status');
            $table->string('excerpt')->nullable()->index();
            $table->longText('content');
            $table->longText('preview')->nullable();
            $table->longText('aside')->nullable();
            $table->string('image')->nullable();
            $table->boolean('sticky')->default(false);
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
        Schema::dropIfExists('reports');
    }
};
