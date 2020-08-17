<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportFailuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_failures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_result_id');
            $table->string('type');
            $table->text('details');
            $table->timestamps();
            $table->foreign('import_result_id')
                ->references('id')
                ->on('import_results')
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
        Schema::dropIfExists('import_failures');
    }
}
