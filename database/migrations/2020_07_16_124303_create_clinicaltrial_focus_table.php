<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicaltrialFocusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinicaltrial_focus', function (Blueprint $table) {
            $table->bigInteger('clinicaltrial_id');
            $table->bigInteger('focus_id');
            $table->primary(['clinicaltrial_id', 'focus_id']);
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
        Schema::dropIfExists('clinicaltrial_focus');
    }
}
