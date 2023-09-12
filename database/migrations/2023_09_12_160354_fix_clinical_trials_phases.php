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
        Schema::create('ct_phases', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->timestamps();
        });

        Schema::create('clinicaltrial_phase', function (Blueprint $table) {
            $table->foreignId('clinicaltrial_id')->references('id')->on('clinicaltrials')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ct_phase_id')->references('id')->on('ct_phases')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('clinicaltrial_phase');
        Schema::dropIfExists('ct_phases');
    }
};
