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
        Schema::create('import_results', function (Blueprint $table) {
            $table->id();
            $table->string('entity');
            $table->bigInteger('focus_id')->nullable();
            $table->longText('csv')->nullable();
            $table->longText('location_messages')->nullable();
            $table->longText('people_messages')->nullable();
            $table->longText('company_messages')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('import_results');
    }
};
