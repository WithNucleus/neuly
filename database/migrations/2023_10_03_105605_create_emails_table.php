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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_template_id')->nullable()->references('id')->on('email_templates')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('email_journey_id')->nullable()->references('id')->on('email_journeys')->nullOnDelete();
            $table->foreignId('email_sequence_id')->nullable()->references('id')->on('email_sequences')->nullOnDelete();
            $table->foreignId('email_trigger_id')->nullable()->references('id')->on('email_triggers')->nullOnDelete();
            $table->string('status')->default(\App\Models\Email::STATUS_NEW);
            $table->string('from_name')->default(config('mail.from.name'));
            $table->string('from_email')->default(config('mail.from.address'));
            $table->string('subject')->index();
            $table->string('to_name');
            $table->string('to_email');
            $table->longText('body');
            $table->json('response')->nullable();
            $table->dateTime('send_at')->nullable();
            $table->dateTime('sent_at')->nullable();
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
        Schema::dropIfExists('emails');
    }
};
