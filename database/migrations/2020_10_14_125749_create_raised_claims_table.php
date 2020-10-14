<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaisedClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raised_claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
                ->on('people')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('user_id');
            $table->string('verification_token')->nullable(true);
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
        Schema::dropIfExists('raised_claims');
    }
}
