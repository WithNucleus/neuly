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
        Schema::create('clinicaltrial_parsing_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinicaltrial_id')->unique();
            $table->text('brief_summary')->nullable();
            $table->text('detailed_description')->nullable();
            $table->timestamps();

            $table->foreign('clinicaltrial_id')
                ->references('id')
                ->on('clinicaltrials')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinicaltrial_parsing_results');
    }
};
