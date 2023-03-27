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
        Schema::create('clinicaltrial_location', function (Blueprint $table) {
            $table->bigInteger('clinicaltrial_id');
            $table->bigInteger('location_id');
            $table->primary(['clinicaltrial_id', 'location_id']);
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
        Schema::dropIfExists('clinicaltrial_location');
    }
};
