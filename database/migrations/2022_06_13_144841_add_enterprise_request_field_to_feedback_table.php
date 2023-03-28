<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('feedback', function (Blueprint $table) {
            DB::statement("ALTER TABLE feedback MODIFY COLUMN type ENUM('problem', 'feedback', 'bug', 'suggestion', 'feature request', 'demo request', 'enterprise request')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            DB::statement("ALTER TABLE feedback MODIFY COLUMN type ENUM('problem', 'feedback', 'bug', 'suggestion', 'feature request', 'demo request')");
        });
    }
};
