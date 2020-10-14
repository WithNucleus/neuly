<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonRelationshipUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint  $table) {
           $table->unsignedInteger('person_id')->nullable(true);

           $table->foreign('person_id')
               ->references('id')
               ->on('people')
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
        Schema::table('users', function (Blueprint $table) {
           $table->dropForeign(['person_id']);
        });
        Schema::table('users', function (Blueprint  $table) {
            $table->dropColumn('person_id');
        });
    }
}
