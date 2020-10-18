<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFocusInvestorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('focus_investor');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('focus_investor', function (Blueprint $table) {
            $table->unsignedBigInteger('focus_id');
            $table->unsignedBigInteger('investor_id');
            $table->timestamps();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
}
