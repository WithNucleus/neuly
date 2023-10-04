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
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->foreignId('email_template_id')->nullable()->references('id')->on('email_templates')->nullOnDelete();
            $table->string('status')->default(\App\Models\EmailCampaign::STATUS_ACTIVE);
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('trigger')->nullable();
            $table->string('from_name')->default(config('mail.from.name'));
            $table->string('from_email')->default(config('mail.from.address'));
            $table->string('subject')->nullable()->index();
            $table->longText('body')->nullable();
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
        Schema::dropIfExists('email_campaigns');
    }
};
