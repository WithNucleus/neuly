<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibiltyToPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->enum('visibility', ['neuly', 'public'])->default('public');
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
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
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('visibility');
            $table->dropColumn('user_id');
        });
    }
}
