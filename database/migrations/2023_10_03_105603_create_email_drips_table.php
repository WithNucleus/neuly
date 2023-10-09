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
        Schema::create('email_drips', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->integer('order');
            $table->string('delay');
            $table->foreignId('email_campaign_id')->nullable()->references('id')->on('email_campaigns')->nullOnDelete();
            $table->foreignId('email_template_id')->nullable()->references('id')->on('email_templates')->nullOnDelete();
//            $table->string('from_name')->default(config('mail.from.name'));
//            $table->string('from_email')->default(config('mail.from.address'));
//            $table->string('subject')->index();
//            $table->longText('body');
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
        Schema::dropIfExists('email_drips');
    }
};
