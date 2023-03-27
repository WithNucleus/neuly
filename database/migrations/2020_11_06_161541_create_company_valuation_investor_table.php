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
        Schema::create('company_valuation_investor', function (Blueprint $table) {
            $table->unsignedBigInteger('company_valuation_id');
            $table->unsignedBigInteger('investor_id');

            $table->foreign('company_valuation_id')
                ->references('id')
                ->on('company_valuations')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_valuation_investor');
    }
};
