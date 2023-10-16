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
        Schema::create('email_sequences', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('delay')->nullable();
            $table->foreignId('email_journey_id')->nullable()->references('id')->on('email_journeys')->nullOnDelete();
            $table->foreignId('email_template_id')->nullable()->references('id')->on('email_templates')->nullOnDelete();
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
        Schema::dropIfExists('email_sequences');
    }
};
