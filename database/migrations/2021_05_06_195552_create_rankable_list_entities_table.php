<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankableListEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankable_entities', function (Blueprint $table) {
            $table->unsignedBigInteger('ranked_list_id');
            $table->unsignedBigInteger('rankable_id');
            $table->string('rankable_type');
            $table->integer('rank')->default(1);

            $table->foreign('ranked_list_id')
                ->references('id')
                ->on('ranked_lists')
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
        Schema::dropIfExists('rankable_entities');
    }
}
