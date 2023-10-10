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
        Schema::create('email_triggers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->string('description');
            $table->string('trigger')->unique();
            $table->string('status')->default(\App\Models\EmailTrigger::STATUS_ACTIVE);
            $table->foreignId('auto_response_id')->nullable()->references('id')->on('email_templates')->nullOnDelete();
            $table->foreignId('email_journey_id')->nullable()->references('id')->on('email_journeys')->nullOnDelete();
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
        Schema::dropIfExists('email_triggers');
    }
};
