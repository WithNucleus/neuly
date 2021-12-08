<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class CreateUserTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_teams', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('member_id');
            $table->timestamps();

            $table->primary(['owner_id', 'member_id']);
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('member_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Role::create(['name' => 'Team owner']);
        Role::create(['name' => 'Team member']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_teams');

        Role::whereIn('name', ['Team owner', 'Team member'])->delete();
    }
}
