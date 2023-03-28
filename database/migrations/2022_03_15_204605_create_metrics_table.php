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
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type')->default('daily');
            $table->string('notes')->nullable();
            $table->integer('organizations')->default(0);
            $table->integer('people')->default(0);
            $table->integer('investors')->default(0);
            $table->integer('events_total')->default(0);
            $table->integer('events_upcoming')->default(0);
            $table->integer('events_past')->default(0);
            $table->integer('jobs_total')->default(0);
            $table->integer('jobs_open')->default(0);
            $table->integer('jobs_archived')->default(0);
            $table->integer('media_items_total')->default(0);
            $table->integer('news')->default(0);
            $table->integer('articles')->default(0);
            $table->integer('images')->default(0);
            $table->integer('videos')->default(0);
            $table->integer('mixed_media')->default(0);
            $table->integer('podcasts')->default(0);
            $table->integer('books')->default(0);
            $table->integer('patent_filings')->default(0);
            $table->integer('courses')->default(0);
            $table->integer('patents')->default(0);
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
        Schema::dropIfExists('metrics');
    }
};
