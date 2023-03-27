<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['problem', 'feedback', 'bug', 'suggestion', 'feature request']);
            $table->enum('status', ['open', 'awaiting response', 'in progress', 'closed'])->default('open');
            $table->text('content');
            $table->bigInteger('user_id')->nullable(true);
            $table->bigInteger('assignee_id')->nullable(true);
            $table->string('user_name')->nullable(true);
            $table->string('user_email')->nullable(true);
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
        Schema::dropIfExists('feedback');
    }
}
