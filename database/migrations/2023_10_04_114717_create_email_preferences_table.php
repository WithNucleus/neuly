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
        Schema::create('email_preferences', function (Blueprint $table) {
            $table->string('email')->unique()->primary();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->boolean('marketing');
            $table->boolean('do_not_email')->default(0);
            $table->string('opt_in_ip')->nullable();
            $table->dateTime('opt_out')->nullable();
            $table->string('opt_out_ip')->nullable();
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
        Schema::dropIfExists('email_preferences');
    }
};
