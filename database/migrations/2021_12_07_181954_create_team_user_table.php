<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class CreateTeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_user', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->primary(['team_id', 'user_id']);
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Role::create(['name' => 'Team member']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_user');

        Role::where('name', 'Team member')->delete();
    }
}
