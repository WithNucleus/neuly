<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('email')->unique();
            $table->string('code');
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
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
        Schema::dropIfExists('team_invitations');
    }
}
